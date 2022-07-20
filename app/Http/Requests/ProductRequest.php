<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'cat_id'=>[
                'required',
                 Rule::exists("categories", "id"),
            ],
            'name'=>[
                'required',
                Rule::unique('products')->ignore($this->route('product')),
                'min:3',
                'max:50'
            ],
            'slug'=>[
                'required',
                'max:80'
            ],
            'small_description'=>[
                'required',
                'min:5',
                'max:1000'
            ],
            'description'=>[
                'required',
                'min:5',
                'max:5000'
            ],
            'orginal_price'=>[
                'required',
                'max:8'
            ],
            'seller_price'=>[
                'required',
                'max:8'
            ],
            'image' => [
                'nullable',
                'image:jpg,jpeg,png',
            ],
            'qty'=>[
                'required',
                'max:10'
            ],
            'tax'=>[
                'required',
                'max:5'
            ],
            'keyword'=>[
                'required',
                'max:50'
            ],
        ];
    }
}
