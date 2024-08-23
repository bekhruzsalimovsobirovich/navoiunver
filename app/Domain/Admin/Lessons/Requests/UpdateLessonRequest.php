<?php

namespace App\Domain\Admin\Lessons\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'file_id' => 'sometimes|integer',
            'course_id' => 'required',
            'course_plan_id' => 'required',
            'course_subject_id' => 'required',
            'date' => 'required',
            'file' => 'sometimes|file|mimes:jpg,jpeg,png,pdf,docx,mp4,mpeg,avi,zip,rar|max:204800',
            'lesson' => 'sometimes|json'
        ];
    }
}
