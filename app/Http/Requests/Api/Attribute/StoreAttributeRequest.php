<?php

namespace App\Http\Requests\Api\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:attributes,name',
            'type' => 'required|in:text,date,number,select'
        ];
    }
}
