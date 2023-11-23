<?php

namespace App\Http\Requests\ClientSide\Post;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

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
            'community_id' => ['required_if:post,null', 'integer', 'exists:communities,id'],
            'title' => ['required', 'string'],
            'image' => ['sometimes', 'image', 'max:8192'], //, 'required_if:description,null'
            'description' => ['sometimes', 'string'], //, 'required_if:image,null'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hasTitle = $this->has('title');
            $hasCommunity = $this->post ?? $this->has('community_id');
            $hasImage = $this->has('image');
            $hasDescription = $this->has('description');

            $presentFields = [$hasTitle, $hasImage, $hasDescription, $hasCommunity];
            $countPresentFields = count(array_filter($presentFields));

            if ($countPresentFields < 3) {
                $validator->errors()->add('Invalid request', "At least three fields are required, including 'title', 'group'.");
            }

            if ($countPresentFields > 4) {
                $validator->errors()->add('Invalid request', 'Only three fields are allowed.');
            }
        });
    }
}
