<?php

namespace App\Http\Controllers;

use App\Classes\Server\ServerCommunicator;
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

    public function removeCourse($course){// remove the given course from the database and the remote server
        $user = Auth::user(); // get the current user
        $server = ServerCommunicator::getInstance(); // server communicator instance
        $server->delete_course($user->id,$course); // deleting the course form the remote server
        // shoeing the user page
        $course_object = course::where('user_id',$user->id)
            ->where('course_id',$course)
            ->delete(); // delete  data from database
        $courses = course::where('user_id',$user->id)->get(); // read course details
        return view('pages.course.courses',compact('courses'));

    }

    public function createCourse(CreateCourseRequest $request){ // add new course to database
        $user = Auth::user();
        $course = new course();
        $course->course_id = strtoupper($request->course_id);
        $course->name = $request->course_name;
        $course->user_id = $user->id;
        $course->save();
        $status = true; // the status of the process
        return view('pages.course.success',compact('status'));
    }
}
