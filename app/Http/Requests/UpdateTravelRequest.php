<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTravelRequest extends FormRequest
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
            'city' => 'required',
            'postcode' => 'required|min:5',
            'description' => 'required',
            'name' => 'required',
            'email' => 'required_without:phone_number',
            'phone_number' => 'required_without:email'
        ];
    }
}
