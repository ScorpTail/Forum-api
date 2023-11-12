<?php

namespace App\Http\Requests\ClientSide\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'image' => ['sometimes', 'image', 'max:8192'],
            'description' => ['sometimes', 'string'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hasTitle = $this->has('title');
            $hasImage = $this->has('image');
            $hasDescription = $this->has('description');

            if ($hasTitle && $hasImage && $hasDescription) {
                $validator->errors()->add('field combination', 'Invalid combination of fields');
            }

            if ($hasTitle && !$hasImage && !$hasDescription) {
                $validator->errors()->add('Invalid request', 'Required two fields, present one');
            }
        });
    }
}
