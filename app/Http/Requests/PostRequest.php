<?php

namespace App\Http\Requests;

use App\Enums\ContentStatus;
use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|min:4|max:255',
            'slug' => 'required|string|min:4|max:255',
            'status' => ['required', 'string', 'in:' . implode(',', ContentStatus::values())],
            'image' => 'nullable|url|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'integer|exists:categories,id',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $postId = $this->route('post')?->id;
            $rules['slug'] .= '|unique:posts,slug,' . $postId;
        }

        return $rules;
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'category_ids.*.exists' => 'One or more selected categories do not exist.',
        ];
    }
}
