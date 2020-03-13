<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyDiscountRequest extends FormRequest
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
            'person_data_id' => 'required',
            'discount_percentage' => 'required|between:0,99.99',
            'start_date' => 'date|required',
            'end_date' => 'date|required',
            'discounted_total' => 'numeric|required|between:0,999999999.999',
            'active' => 'boolean',
        ];
    }
}
