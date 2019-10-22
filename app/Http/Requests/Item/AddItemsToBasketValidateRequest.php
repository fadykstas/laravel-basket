<?php

namespace App\Http\Requests\Item;

use App\Entities\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddItemsToBasketValidateRequest extends FormRequest
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
            'items.*.type' => ['required', 'string', Rule::in(Item::ALLOWED_TYPES)],
            'items.*.weight' => 'required|numeric|min:1'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'items.*.type.required' => 'items.*.type is required!',
            'items.*.type.string' => 'items.*.type. is string!',
            'items.*.type.in' => 'items.*.type should be one of: ' . implode(', ',Item::ALLOWED_TYPES),
            'items.*.weight.required' => 'items.*.weight is required!',
            'items.*.weight.numeric' => 'items.*.weight is numeric!',
        ];
    }
}
