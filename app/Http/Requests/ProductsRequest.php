<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'product_name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'sale_price' => 'required',
            'cost_price' => 'required',
            'quantity' => 'required',
            'minimum_quantity' => 'required',
            'weight' => 'required',
            'ncm' => 'required',
            'cst_pis' => 'required',
            'cst_cofins' => 'required',
            'pis_percentage' => 'required',
            'cofins_percentage' => 'required',
            'cfop' => 'required',
            'ean' => 'required'
        ];
    }
}


