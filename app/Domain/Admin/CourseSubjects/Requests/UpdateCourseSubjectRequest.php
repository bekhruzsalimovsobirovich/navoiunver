<?php

namespace App\Domain\Admin\CourseSubjects\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseSubjectRequest extends FormRequest
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
            'course_plan_id' => 'required',
            'name' => 'required',
            'course_subject' => 'sometimes|json'
        ];
    }
}
