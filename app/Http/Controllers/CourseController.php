<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\course;
use App\User;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function listCourses(){
        $user = Auth::user();
        $courses = course::where('user_id',$user->id)->get(); // read course details
        return view('pages.course.courses',compact('courses'));
    }
}
