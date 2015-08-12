<?php

namespace App\Http\Controllers;

use App\Classes\Server\Compiler;
use App\Classes\Server\ServerCommunicator;
use Carbon\Carbon;
use App\Http\Requests\CreateAssignmentRequest;
use Request;
use Storage;
use File;
use DB;
use Response;
use Input;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function contact(){
        return view('pages.contact');
    }

    public function home(){
        return view('pages.home');
    }

    public function courses(){
        $courses = DB::select('select * from course WHERE user_name = ?' , ['tharakamd']);
        return view('pages.courses',compact('courses'));
    }

    public function assignment($course){
        $assignments = DB::select('select * from assignment WHERE  user_name = ? AND  course_id = ?', ['tharakamd',$course]);
        return view('pages.assignment',compact('assignments','course'));
    }

    public function code($course,$assignment){
        $codes = DB::select('select * from source_code WHERE course_id = ? AND ass_id = ? AND user_name = ?', array($course,$assignment,'tharakamd'));
        return view('pages.code',compact('course','assignment','codes'));
    }

    public function upload_file($user,$course,$assignment){
        $file = Request::file('code_path');
        $extension = $file->getClientOriginalExtension();
        $file_actual_name = $file-> getClientOriginalName();
        if(Storage::disk('local')->put($file_actual_name ,  File::get($file))) // uploading the file to web server
        {
           $server = ServerCommunicator::getInstance();
           if($server->upload_file($user,$course,$assignment,storage_path().'/files/'.$file_actual_name,$file_actual_name)){ // uploading the file to ftp server
               // creating data to update the database
               $name = $file_actual_name;
               $type = 'java';
               $date_time = Carbon::now();
               $added_date = $date_time->toDateString();
               $status = 'uploded';
               $marks = '0';
               $ass_id = $assignment;
               $course_id = $course;
               $username = $user;
               if(DB::insert('insert into source_code (name,type,added_date,status,marks,ass_id,course_id,user_name) VALUE (?, ?, ?, ?, ?, ?, ?, ?)',array($name,$type,$added_date,$status,$marks,$ass_id,$course_id,$username)))// updating the database
               {
                   return view('pages.uploaded',array('status'=>'done','assignment'=>$assignment,'course'=>$course));
               }
           }
        }
        return view('pages.uploaded',array('status'=>'fail','assignment'=>$assignment,'course'=>$course));
    }

    public function compile($user,$course,$assignment){
        $compiler = Compiler::getInstance(); // new compiler instance to compile the file
        $codes = DB::select('select * from source_code WHERE course_id = ? AND ass_id = ? AND user_name = ?', array($course,$assignment,$user));
        foreach($codes as $code){
            $result = $compiler->compile($user,$course,$assignment,$code->name,'java'); // compile and get the result
              if($result){
                  $code->status = 'compiled';
              }else {
                  $code->status = 'compilation error';
              }
        }
        return view('pages.compiled',compact('codes'));
    }


}


