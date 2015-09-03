<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class CreateCourseRequest extends Request
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
        $user = Auth::user(); // the authenticated user
        return [
            'course_id' => "required|unique:course,course_id,NULL,course_id,user_id,$user->id|max:10",
            'course_name' => 'required|max:50',
        ];
    }
}
