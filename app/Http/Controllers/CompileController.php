<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Server;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompileController extends Controller
{
    /**
     * @return string
     */
    public function index(){



        $ins = Server\ServerCommunicator::getInstance();

        $res = 'fail';
        if($ins->go_to_directory("aa","aaa","aaaa")){
            $res = 'done';
        }else{
            $res = 'fail';
        }
        return view('pages.compiler',compact('res'));
    }

    public function compile(){
        return view('pages.compiler');
    }

    public function compile_test(){
          $ins = Server\FtpConnector::getInstance();
         if($ins->connect_and_login()){
            return "done";
         }else
            return "fail";
    }

    public function upload_file(){
        $instant = Server\ServerCommunicator::getInstance();
        if($instant->upload_file("fol1","fol2","fol3",storage_path()."/files/test.py","test.py")){
            return "done uploading";
        }else{
            return "fail uploading";
        }
    }

    public function compile_file(){
        $instant = Server\ServerCommunicator::getInstance();
        if($result = $instant->compile_a_file("fol1","fol2","fol3","test.py")){
            return $result;
        }else{
            return "fail compiling";
        }

    }
}
