<?php

namespace App\Ecommerce\V1\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerNew extends FormRequest
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
            'name' => 'required|string|max:255',
            'cpf' => 'required|cpf|unique:customers,cpf|max:11',
            'email' => 'required|email|unique:customers,email|max:255',
            'password' => 'required|string|max:255'
        ];
    }
   
}