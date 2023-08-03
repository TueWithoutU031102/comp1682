<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateCart extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The dish ID is required.',
            'id.numeric' => 'The dish ID must be a number.',
            'quantity.required' => 'The quantity is required.',
            'quantity.numeric' => 'The quantity must be a number.',
            'quantity.min' => 'The quantity must be at least :min.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 400,
            'message' => 'Invalid request data',
            'errors' => $validator->errors(),
        ], 400));
    }
}
