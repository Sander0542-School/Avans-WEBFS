<?php

namespace App\Http\Requests\Order;

use App\Models\Dish;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'table_order' => [
                'required',
                'boolean',
            ],
            'table_number' => [
                'required_if:table_order,true',
            ],
            'cart' => [
                'required',
                'array',
                'min:1',
            ],
            'cart.*.id' => [
                'required',
                'integer',
                Rule::exists(Dish::class, 'id'),
            ],
            'cart.*.amount' => [
                'required',
                'integer',
                'min:1',
            ],
            'cart.*.remark' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cart.*.id.exists' => 'Dit product is niet beschikbaar',
        ];
    }
}
