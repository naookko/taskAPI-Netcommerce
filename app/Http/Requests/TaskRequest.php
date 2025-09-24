<?php

namespace App\Http\Requests;

use App\Rules\PendingTasksRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
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
            'company_id' => ['required', 'exists:App\Models\Company,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'user_id' => ['required', 'integer', 'exists:App\Models\User,id', new PendingTasksRule($this->user_id)],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.exists' => 'Company not found',
            'user_id.exists' => 'User not found',
            'user_id.required' => 'User id is required',
            'company_id.required' => 'Company id is required',
            'name.required' => 'Task name is required',
            'description.required' => 'Task description is required',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));

    }
}
