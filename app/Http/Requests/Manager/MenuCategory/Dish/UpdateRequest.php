<?php

namespace App\Http\Requests\Manager\MenuCategory\Dish;

use App\Models\Allergy;
use App\Models\Dish;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'addition' => [
                'nullable',
                'string',
                'max:4',
            ],
            'number' => [
                'required',
                'string',
                'max:4',
                Rule::unique(Dish::class, 'number')->where('addition', $this->get('addition'))
                    ->ignore($this->route('dish')->id),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
                'max:255',
            ],
            'btw' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],
            'spiciness_level' => [
                'nullable',
                'integer',
                'in:1,2,3',
            ],
            'allergies' => [
                'nullable',
                'array',
            ],
            'allergies.*' => [
                'integer',
                Rule::exists(Allergy::class, 'id'),
            ],
        ];
    }
}
