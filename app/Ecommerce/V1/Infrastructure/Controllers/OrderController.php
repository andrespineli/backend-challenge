<?php

namespace App\Ecommerce\V1\Infrastructure\Controllers;

use App\Ecommerce\V1\Infrastructure\Controllers\Controller;
use App\Ecommerce\V1\Infrastructure\Requests\OrderNew;
use App\Ecommerce\V1\Infrastructure\Requests\OrderCancel;
use App\Ecommerce\V1\Components\Order\OrderComponent;

class OrderController extends Controller
{
    private $order; 

    public function __construct(OrderComponent $order) 
    {
        $this->order = $order;
    }

    public function new(OrderNew $order)
    {
        $order = $order->validated();      
        return $this->order->newOrder($order);       
    } 

    public function get()
    {
        return $this->order->getOrders();
    }  

    public function cancel(OrderCancel $request)
    {
        $request = $request->all();      
        return $this->order->cancelOrder($request['order_id']);
    }
}
