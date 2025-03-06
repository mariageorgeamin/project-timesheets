<?php

namespace App\Http\Requests\Api\Timesheet;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'task_name' => 'required|string|max:255',
            'date' => 'required|date|date_format:Y-m-d',
            'hours' => 'required|numeric|min:0.5|max:24',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
