<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAssignmentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'assignment_id' => 'required|max:10',
            'assignment_name' => 'required|max:50',
            'test_cases' => 'required|mimes:zip',
            'test_results' => 'required|mimes:csv,txt'
        ];
    }
}
