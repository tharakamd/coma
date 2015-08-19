<?php

namespace App\Http\Controllers;

use App\Classes\Server\Compiler;
use App\Classes\Server\ServerCommunicator;
use Carbon\Carbon;
use App\Classes\Server\JavaCompiler;
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

    public function showLoging(){
        return view('auth.login');
    }

    public function showSignup(){
        return view('auth.register');
    }


    public function contact(){
        return view('pages.contact');
    }

    public function home(){
        return view('pages.home');
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

        $java_compiler = JavaCompiler::getInstance(); // java compiler instance
        $results = $java_compiler->compile_recursive($user,$course,$assignment); // compile and get the results
        $codes = DB::select('select * from source_code WHERE course_id = ? AND ass_id = ? AND user_name = ?', array($course,$assignment,$user)); // get the list of codes
        $number = 0;
        foreach($codes as $code){
            $result = $results[$number]; // get the related marks to current code
            if($result->is_compiled()){ // update the status of the code
                $code->status = 'compiled';
            }else{
                $code->status = 'compilation error';
            }
            $code->marks = $result->get_marks(); // update the marks of the code

        }
        return view('pages.compiled',compact('codes'));
    }


}


