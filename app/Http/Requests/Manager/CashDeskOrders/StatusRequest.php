<?php

namespace App\Http\Requests\Manager\CashDeskOrders;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class StatusRequest extends FormRequest
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
            'status' => [
                'required',
                new EnumRule(OrderStatus::class),
            ],
        ];
    }
}
