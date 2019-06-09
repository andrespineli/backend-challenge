<?php

namespace App\Ecommerce\V1\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class AuthLogIn extends FormRequest
{
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

            $customer = Customer::where('email', '=', $this['email'])->first();

            if (!$customer) {
                $validator->errors()->add('email', 'Not found email.');
                return;
            }

            if ($customer->password != $this['password']) {
                $validator->errors()->add("password", "Incorrect password for email {$this['email']}");
                return;
            }
        });
    }
}
