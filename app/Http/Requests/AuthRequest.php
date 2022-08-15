<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class AuthRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'email'         => ['required','email'],
            'password'      => ['required']
        ];
    }

    /**
     * If the validation fails, throw an HTTP response exception with a JSON response containing the
     * validation errors
     * 
     * @param Validator validator The validator instance.
     */
    public function failedValidation(Validator $validator) : Response
    {

        throw new HttpResponseException(response()->json([
            'status'   => 'failed',
            'message'      => $validator->errors()

        ], Response::HTTP_BAD_REQUEST));

    }

    /**
     * The `messages()` function returns an array of key-value pairs, where the key is the name of the
     * field that failed validation, and the value is the error message to be displayed
     * 
     * @return array An array of messages.
     */
    public function messages() : array
    {
        return [
            'email.required' => 'Email required',
            'password.required' => 'Password required',
        ];
    }
}
