<?php

namespace App\Http\Requests\Api\Project;

use App\Rules\ValidateAttributes;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:projects,name',
            'status' => 'required|string|max:50',
            'attributes' => ['array', new ValidateAttributes()],
        ];
    }
}
