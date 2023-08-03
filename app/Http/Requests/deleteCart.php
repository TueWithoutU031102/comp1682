<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class deleteCart extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'The dish ID is required.',
            'id.numeric' => 'The dish ID must be a number.',
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
