<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Code;
use Maatwebsite\Excel\Facades\Excel;
use Request;
use Storage;
use File;
use DB;
use Response;
use Input;
use Illuminate\Support\Facades\Auth;
use App\Classes\Server\ServerCommunicator;
use App\Classes\Server\JavaCompiler;
use App\Http\Requests\uploadSingleCode;
use App\Http\Requests\uploadBulkCode;
use App\Classes\Server\Compiler;
use App\Classes\Server\CompilerFactory;


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

    public function uploadZipFile(uploadBulkCode $request,$course,$assignment){
        $user = Auth::user(); // current authenticated user
        $file = $request->file('file_path'); // the file to upload
        $file_name = 'codes.zip'; // the final name of the file
        if(Storage::disk('local')->put($file_name,File::get($file))){ // uploading the file to web servers
            $server = ServerCommunicator::getInstance(); // new server object
            if($server->upload_code_zip($user->id,$course,$assignment,storage_path().'/files/'.$file_name)){ // uploading it to remote server and unzip file
               $file_list = $server->get_file_list($user->id,$course,$assignment,'.java'); // the list of uploaded files
                foreach($file_list as $single_file){ // iterating through files
                    $code = new Code();
                    $code->name = $single_file;
                    $code->type = 'java';
                    $code->status = 'uploded';
                    $code->marks = 0;
                    $code->assignment_id = $assignment;
                    $code->course_id = $course;
                    $code ->user_id = $user->id;
                    $code->save(); // adding new entry to the database
                }
                $codes = Code::where('user_id',$user->id)
                    ->where('course_id',$course)
                    ->where('assignment_id',$assignment)
                    ->get();
                return view('pages.code.code',compact('course','assignment','codes','user'));
            }
        }
        return view('pages.uploaded',array('status'=>'fail','assignment'=>$assignment,'course'=>$course));
    }

    public function uploadFile(uploadSingleCode $request,$course,$assignment){
        $user = Auth::user(); // current authenticated user
        $file = $request->file('code_path');
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

    public function removeCode($course,$assignment,$code){
        $user = Auth::user(); // get the authenticated user
        $code_object = Code::where('user_id',$user->id)
            ->where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->where('code_id',$code)
            ->get(); // getting the current code object
        $server = ServerCommunicator::getInstance(); // new server object
        $server->delete_file($user->id,$course,$assignment,$code_object[0]->name); // deleting the file from the server
        $code_object[0]->delete(); // deleting the code data from database

        $codes = Code::where('user_id',$user->id)
            ->where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->get();
        return view('pages.code.code',compact('course','assignment','codes','user'));
    }

    /**
     * @param $course
     * @param $assignment
     * @return \Illuminate\View\View
     */
    public function compileAll($course,$assignment){
        $user = Auth::user(); // authenticated user
        $compiler = CompilerFactory::createCompiler("java"); // pass a new value instead of java to make another compiler
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
            $number++; // increase the result number
        }
        $codes = Code::where('user_id',$user->id)
            ->where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->get();
        return view('pages.code.code',compact('course','assignment','codes','user'));
    }

    public function generateExcell($course,$assignment,$ext){
        $user = Auth::user(); // the current authenticated user

        // generating the result array
        $results = array(
            array('File Name','Type','Status','Marks')
        );
        $codes = Code::where('user_id',$user->id)
            ->where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->get(); // getting the codes
        foreach($codes as $code){
            array_push($results,array($code->name,$code->type,$code->status,$code->marks));
        }

        Excel::create('filename', function($excel) use($results){
            // Set the title
            $excel->setTitle('The title');
            // Chain the setters
            $excel->setCreator('Coma')
                ->setCompany('Coma');
            // Call them separately
            $excel->setDescription('This excell file is created by Coma automated code evaluator !!!');

            // creating the new sheet
            $excel->sheet('sheet one', function($sheet) use($results){
                    $sheet->fromModel($results);
            });


        })->export($ext); // creating a new excell instance

    }


}
