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










}


