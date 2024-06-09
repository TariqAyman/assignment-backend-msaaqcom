<?php

namespace App\Http\Requests\V1\Tenant\Quiz;

use App\Enums\QuestionType;
use App\Enums\QuizType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuizUpdatenRequest extends FormRequest
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
            "title" => ['required', 'string', 'max:255'],
            "description" => ['required', 'string', 'max:255'],
            "type" => ['required', Rule::in(QuizType::toValidationRequest())],
            "start_date" => ['required_if:type,in-time', 'nullable', 'date', 'after:now'],
            "end_time" => ['required_if:type,in-time', 'nullable', 'date', 'after:start_date'],
            "questions" => ['required', 'array'],
            "questions.*.type" => ['required', Rule::in(QuestionType::toValidationRequest())],
            "questions.*.question" => ['required', 'string', 'max:255'],
            "questions.*.description" => ['nullable', 'string', 'max:255'],
            "questions.*.is_correct" => ['required_if:questions.*.type,=,true_false'],
            "questions.*.choices" => ['required_if:questions.*.type,=,choices', 'nullable','array'],
            "questions.*.choices.*.title" => ['required_with:questions.*.choices', 'string','max:255'],
            "questions.*.choices.*.description" => ['required_with:questions.*.choices', 'string','max:255'],
            "questions.*.choices.*.explanation" => ['required_with:questions.*.choices', 'string','max:255'],
            "questions.*.choices.*.order" => ['required_with:questions.*.choices', 'integer','max:255'],
            "questions.*.choices.*.is_correct" => ['required_with:questions.*.choices', 'boolean','max:255'],
        ];
    }
}
