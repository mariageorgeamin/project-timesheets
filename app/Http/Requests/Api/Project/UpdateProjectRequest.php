<?php

namespace App\Http\Requests\Api\Project;

use App\Rules\ValidateAttributes;
use Illuminate\Foundation\Http\FormRequest;

class   UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:50',
            'attributes' => ['array', new ValidateAttributes()],
        ];
    }
}
