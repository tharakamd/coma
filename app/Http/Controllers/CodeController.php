<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Code;
use Request;
use Storage;
use File;
use DB;
use Response;
use Input;
use Illuminate\Support\Facades\Auth;
use App\Classes\Server\ServerCommunicator;
use App\Classes\Server\JavaCompiler;

class CodeController extends Controller
{
    public function listCodes($course,$assignment){
        $user = Auth::user(); // the authenticated user
        $codes = Code::where('user_id',$user->id)
            ->where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->get();
        return view('pages.code.code',compact('course','assignment','codes','user'));
    }

    public function uploadFile($course,$assignment){
        $user = Auth::user(); // current authenticated user
        $file = Request::file('code_path');
        $extension = $file->getClientOriginalExtension();
        $file_actual_name = $file-> getClientOriginalName();
        if(Storage::disk('local')->put($file_actual_name ,  File::get($file))) // uploading the file to web server
        {
            $server = ServerCommunicator::getInstance();
            if($server->upload_file($user->id,$course,$assignment,storage_path().'/files/'.$file_actual_name,$file_actual_name)){ // uploading the file to ftp server
                // creating data to update the database

                $code = new Code();
                $code->name = $file_actual_name;
                $code->type = 'java';
                $code->status = 'uploded';
                $code->marks = 0;
                $code->assignment_id = $assignment;
                $code->course_id = $course;
                $code ->user_id = $user->id;
                $code->save();
                return view('pages.code.uploaded',array('status'=>'done','assignment'=>$assignment,'course'=>$course));
            }
        }
        return view('pages.uploaded',array('status'=>'fail','assignment'=>$assignment,'course'=>$course));
    }

    public function compileAll($course,$assignment){
        $user = Auth::user();
        $java_compiler = JavaCompiler::getInstance(); // java compiler instance
        $results = $java_compiler->compile_recursive($user->id,$course,$assignment); // compile and get the results
        $codes = Code::where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->where('user_id',$user->id)
            ->get(); // read all the source code details in the database
        $number = 0;
        foreach($codes as $code){
            $result = $results[$number]; // get the related marks to current code
            if($result->is_compiled()){ // update the status of the code
                $code->status = 'compiled';
            }else{
                $code->status = 'compilation error';
            }
            $code->marks = ($result->get_marks())*100; // update the marks of the code
            $code->save(); // adding it to database
        }
        return view('pages.code.compiled',compact('codes','course','assignment'));
    }
}
