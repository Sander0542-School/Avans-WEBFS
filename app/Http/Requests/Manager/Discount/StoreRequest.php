<?php

namespace App\Http\Requests\Manager\Discount;

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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'discount' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
            'valid_until' => [
                'required',
                'date',
                'after:now',
            ],
        ];
    }
}
