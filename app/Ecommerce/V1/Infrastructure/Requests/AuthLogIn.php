<?php

namespace App\Ecommerce\V1\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Ecommerce\V1\Infrastructure\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Ecommerce\V1\Components\Auth\AuthComponent;

class AuthLogIn extends FormRequest
{
    private $authComponent;

    public function __construct(AuthComponent $authComponent)
    {
        $this->authComponent = $authComponent;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:customers,email|max:255',
            'password' => 'required|string|max:255'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $validate = $this->authComponent->verifyEmailAndPass($this['email'], $this['password']);

            if (!$validate['email'] || !$validate['password']) {
                $validator->errors()->add($validate['field'], $validate['message']);
                return;
            }

        });
    }
}
