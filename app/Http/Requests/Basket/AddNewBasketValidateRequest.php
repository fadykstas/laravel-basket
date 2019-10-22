<?php


namespace App\Http\Requests\Basket;


use App\Http\Requests\JsonRequest;

class AddNewBasketValidateRequest extends JsonRequest
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
            'name'    => 'required|string',
            'maxCapacity'     => 'required|numeric',
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
            'name.required' => 'name is required!',
            'maxCapacity.required' => 'maxCapacity is required!',
            'name.string' => 'name is string!',
            'maxCapacity.numeric' => 'maxCapacity is numeric!',
        ];
    }
}



