<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateImageRequest extends FormRequest
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
        if (request()->isMethod('post')) {
            $rules = [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg',
                ],
            ];
        } elseif (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules = [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg',
                ],
            ];
        }
        return $rules;
    }

    // Custom validation messages
    public function messages(): array
    {
        return [
            // 'name.required' => 'Name required',
        ];
    }
}
