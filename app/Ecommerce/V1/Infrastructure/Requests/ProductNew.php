<?php

namespace App\Ecommerce\V1\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductNew extends FormRequest
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
            'sku' => 'required|integer|unique:products,sku',
            'name' => 'required|string|unique:products,name|max:255',
            'price' => 'required|numeric|min:1'
        ];
    }
   
}