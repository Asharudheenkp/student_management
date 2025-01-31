<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentMarkStoreRequest extends FormRequest
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
            'student_name' => 'required|max:100',
            'subject_id.*' => 'required',
            'mark.*' => 'required|max:100|numeric'
        ];
    }

    public function messages()
    {
        return [
            'subject_id.*.required' => 'Please select a subject',
            'mark.*.required' => 'The mark field is required.',
            'mark.*.max' => 'The mark must not be greater than 100.',
            'mark.*.numeric' => 'The mark should be a number.',

        ];
    }
}
