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
use Illuminate\Support\Facades\Auth;
use App\Assignment;
class AssignmentController extends Controller
{

    public function listAssignments($course){ // view the current assignments
        $user = Auth::user(); // current user
        $assignments =  Assignment::where('user_id',$user->id)
            ->where('course_id',$course)
            ->get(); // read data from the database
        return view('pages.assignment.assignment',compact('assignments','course'));
    }


    public function createAssignment(CreateAssignmentRequest $request,$course){// create a new assignment
            $user = Auth::user(); // current user
            $results = $request->all();
            $assignment_id = $results['assignment_id'];
            $assignment_name = $request['assignment_name'];
            $test_files = Request::file('test_cases');
            $test_results = Request::file('test_results');
            if(Storage::disk('local')->put("testFiles.zip",File::get($test_files)))// uploading the test file as 'testFiles.zip' in the web server
            {
                if(Storage::disk('local')->put('testResult.csv',File::get($test_results))){// uploading the test results as 'testResults.csv' in the web server
                    $server = ServerCommunicator::getInstance(); // creating the server communicator instant
                    if($server->upload_file_special($user->id,$course,$assignment_id,"testCases",storage_path().'/files/'.'testFiles.zip','testFiles.zip')){// uploading the testfiles to ftp server
                        $server->unzip_and_delete_test_files($user->id,$course,$assignment_id); // unziping and deleting the test file zip
                        if($server->upload_file_special($user->id,$course,$assignment_id,"testResults",storage_path().'/files/'.'testResult.csv','testResult.csv')){// uploading the testresults to ftp server
//                           updating the database
                            $assignment = new Assignment(); // new assignment object
                            $assignment->assignment_id = $assignment_id;
                            $assignment->name = $assignment_name;
                            $assignment->user_id = $user->id;
                            $assignment->course_id = $course;
                            $assignment->save(); // adding to the database
                            $assignments =  Assignment::where('user_id',$user->id)
                                ->where('course_id',$course)
                                ->get(); // read data from the database
                            return view('pages.assignment.assignment',compact('assignments','course'));
                        }
                    }
                }
            }
        // in a failure of the process
        $status = false;
        return view('pages.assignment.created',compact('status','course'));
    }

    public function removeAssignment($course,$assignment){
        $user = Auth::user(); // authenticated user
        $assignment_object = Assignment::where('user_id',$user->id)
            ->where('course_id',$course)
            ->where('assignment_id',$assignment)
            ->delete(); // read data from database
        $server = ServerCommunicator::getInstance(); // the server communicator object
        $server->delete_assignment($user->id,$course,$assignment); // deleting the assignment folder form the remote server
        // showing the assignment page
        $assignments =  Assignment::where('user_id',$user->id)
            ->where('course_id',$course)
            ->get(); // read data from the database
        return view('pages.assignment.assignment',compact('assignments','course'));
    }

    public function addAssignment($course){
        return view('pages.assignment.add',compact('course'));
    }



}
