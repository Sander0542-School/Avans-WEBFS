<?php

namespace App\Http\Requests\CashDesk;

use Illuminate\Foundation\Http\FormRequest;

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
            'cart.*.id' => [
                'required',
                'max:50',
                'integer',
                'exists:dishes',
            ],
            'cart.*.quantity' => [
                'required',
                'max:50',
                'integer',
            ],
            'cart.*.remark' => [
                'max:150',
                'string',
                'nullable',
            ],
            'cart.*.dish_rice_option' => [
                'max:150',
                'integer',
                'nullable',
                'exists:dish_rice_options,id'
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
            'cart.*.quantity.required' => 'Een aantal invoeren is verplicht',
            'cart.*.remark.string' => 'Een aantekeing mag alleen uit tekst bestaan.',
        ];
    }
}
