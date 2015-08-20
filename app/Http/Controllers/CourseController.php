<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\course;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCourseRequest;

class CourseController extends Controller
{
    public function listCourses(){ // list down courses
        $user = Auth::user();
        $courses = course::where('user_id',$user->id)->get(); // read course details
        return view('pages.course.courses',compact('courses'));
    }

    public function addCourse(){ // show add new course view
        return view('pages.course.add');
    }

    public function createCourse(CreateCourseRequest $request){ // add new course to database
        $user = Auth::user();
        $course = new course();
        $course->course_id = $request->course_id;
        $course->name = $request->course_name;
        $course->user_id = $user->id;
        $course->save();
        $status = true; // the status of the process
        return view('pages.course.success',compact('status'));
    }
}
