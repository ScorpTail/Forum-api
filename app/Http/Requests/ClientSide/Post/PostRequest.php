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
            'image' => ['sometimes', 'image', 'max:8192', 'required_if:description,null'],
            'description' => ['sometimes', 'string', 'required_if:image,null'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hasTitle = $this->has('title');
            $hasImage = $this->has('image');
            $hasDescription = $this->has('description');

            $presentFields = [$hasTitle, $hasImage, $hasDescription];
            $countPresentFields = count(array_filter($presentFields));

            if ($countPresentFields < 2) {
                $validator->errors()->add('Invalid request', "At least two fields are required, including 'title'.");
            }

            if ($countPresentFields > 2) {
                $validator->errors()->add('Invalid request', 'Only two fields are allowed.');
            }
        });
    }
}
