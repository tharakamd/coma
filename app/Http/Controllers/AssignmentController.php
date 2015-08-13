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

class AssignmentController extends Controller
{
    public function create_assignment(CreateAssignmentRequest $request,$user,$course){// create a new assignment
            $results = $request->all();
            $ass_id = $results['assignment_id'];
            $ass_name = $request['assignment_name'];
            $test_files = Request::file('test_cases');
            $test_results = Request::file('test_results');
            if(Storage::disk('local')->put("testFiles.zip",File::get($test_files)))// uploading the test file as 'testFiles.zip' in the web server
            {
                if(Storage::disk('local')->put('testResult.csv',File::get($test_results))){// uploading the test results as 'testResults.csv' in the web server
                    $server = ServerCommunicator::getInstance(); // creating the server communicator instant
                    if($server->upload_file_special($user,$course,$ass_id,"testCases",storage_path().'/files/'.'testFiles.zip','testFiles.zip')){// uploading the testfiles to ftp server
                        $server->unzip_and_delete_test_files($user,$course,$ass_id); // unziping and deleting the test file zip
                        if($server->upload_file_special($user,$course,$ass_id,"testResults",storage_path().'/files/'.'testResult.csv','testResult.csv')){// uploading the testresults to ftp server
//                           updating the database
                            if(DB::insert('insert into assignment (ass_id,name,course_id,user_name) VALUE (?,?,?,?)',array($ass_id,$ass_name,$course,$user)   )){
                                $status = true;
                                return view('pages.assignment.created',compact('status','course'));
                            }
                        }
                    }
                }
            }
        // in a failure of the process
        $status = false;
        return view('pages.assignment.created',compact('status','course'));
    }

    public function add_assignment($user,$course){
        return view('pages.assignment.add',compact('user','course'));
    }


}
