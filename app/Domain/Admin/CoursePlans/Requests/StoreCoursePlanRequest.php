<?php

namespace App\Domain\Admin\CoursePlans\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoursePlanRequest extends FormRequest
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
            'course_id' => 'required',
            'name' => 'required|string|unique:course_plans,name'
        ];
    }
}
