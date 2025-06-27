<?php

namespace App\Http\Requests;

use App\Enums\ContentStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'body' => 'required|string',
            'status' => ['required', 'string', 'in:' . implode(',', ContentStatus::values())],
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $pageId = $this->route('page')?->id;
            $rules['slug'] .= '|unique:pages,slug,' . $pageId;
        }

        return $rules;
    }
}
