<?php

namespace App\Http\Requests\Api\Project;

use App\Rules\ValidateAttributes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'filters' => ['nullable', 'array'],
            'filters.*.operator' => ['required', Rule::in(['=', '>', '<', 'LIKE'])],
            'filters.*.value' => ['required_without:filters.*.operator'],
        ];
    }

    public function messages()
    {
        return [
            'filters.*.operator.in' => 'Invalid operator. Allowed: =, >, <, LIKE',
            'filters.*.value.required_without' => 'The value field is required if an operator is provided.',
        ];
    }
}
