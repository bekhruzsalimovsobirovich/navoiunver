<?php

namespace App\Domain\Admin\Controls\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreControlRequest extends FormRequest
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
            'name' => 'required',
            'file' => 'sometimes|file|mimes:jpg,jpeg,png|max:20480',
        ];
    }
}
