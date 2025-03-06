<?php

namespace App\Http\Requests\Api\Attribute;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $attribute = $this->route('attribute');

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('attributes', 'name')->ignore($attribute->id),
            ],
            'type' => 'required|in:text,date,number,select'
        ];
    }
}
