<?php

namespace App\Domain\Users\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|unique:users,phone',
            'region' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'postal_code' => 'sometimes|int',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ];
    }
}
