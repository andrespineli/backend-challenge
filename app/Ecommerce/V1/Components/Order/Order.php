<?php

namespace App\Ecommerce\V1\Components\Order;

use App\Ecommerce\V1\Components\Order\OrderComponent;
use App\Ecommerce\V1\Components\Order\OrderRepository;
use App\Ecommerce\V1\Components\Auth\AuthComponent;
use App\Ecommerce\V1\Components\Product\ProductComponent;
use App\Ecommerce\V1\Components\OrderItem\OrderItemComponent;

class Order implements OrderComponent
{
    private $repository;
    private $authComponent;
    private $productComponent;
    private $orderItemComponent;

    public function __construct(
        OrderRepository $repository,
        AuthComponent $authComponent,
        ProductComponent $productComponent,
        OrderItemComponent $orderItemComponent
    ) {
        $this->repository = $repository;
        $this->authComponent = $authComponent;
        $this->productComponent = $productComponent;
        $this->orderItemComponent = $orderItemComponent;
    }

    public function newOrder(array $order): array
    {
        try {
            if (empty($order)) {
                throw new \Exception("Invalid order request.", 1);
            }

            $customer = $this->authComponent->getAuthEntity();

            $newOrder = $this->repository->create([
                "customer_id" => $customer['id'],
                "status"      => "OPENED",
                "total"       => 0
            ]);

            $orderItems = $this->getItemsFromOrder($order['items'], $newOrder['id']);
            $orderTotal = $this->getOrderTotalPriceOfItems($orderItems);
            $addOrderItems = $this->orderItemComponent->addItemsInOrder($orderItems);

            $update = $this->repository->update([
                "id"     => $newOrder['id'],
                "status" => "CONCLUDED",
                "total"  => $orderTotal
            ]);

            if (!$addOrderItems || !$update) {
                throw new \Exception("Order processing failed.", 2);
            }

            return $this->getOrder($update['id']);
        } catch (\Throwable $th) {
            if ($th->getCode() == 2) {
                $this->cancelOrder($newOrder['id']);
            }

            return [
                "message" => $th->getMessage(),
                "code" => $th->getCode()
            ];
        }
    }

    public function getOrders(): array
    {
        return $this->repository->getAllOrders();
    }

    public function getOrder(int $id): array
    {
        return $this->repository->getOrderWithItems($id);
    }

    public function cancelOrder(int $id): array
    {
        return $this->repository->update([
            'id' => $id,
            'status' => "CANCELED"
        ]);
    }

    private function getItemsFromOrder(array $requestItems, int $orderId): array
    {
        foreach ($requestItems as $requestItem) {
            $product = $this->productComponent->getProductBySku($requestItem['sku']);
            $newItem['order_id'] = $orderId;
            $newItem['amount'] = $requestItem['amount'];
            $newItem['product_id'] = $product['id'];
            $newItem['price_unit'] = $product['price'];
            $newItem['total'] = $product['price'] * $requestItem['amount'];
            $newItems[] = $newItem;
        }

        return $newItems;
    }

    private function getOrderTotalPriceOfItems(array $items)
    {
        $totals = array_map(function ($item) {
            return $item['total'];
        }, $items);

        return array_sum($totals);
    }
}
