<?php

namespace App\Domain\Admin\QuestionsAnswers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionAnswerRequest extends FormRequest
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
            'control_id' => 'required',
            'low' => 'required',
            'middle' => 'required',
//            'high' => 'required',
            'low.*' => 'required|array',
            'middle.*' => 'required|array',
//            'high.*' => 'required|array'
        ];
    }
}
