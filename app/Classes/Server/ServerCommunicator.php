<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 30/07/2015
 * Time: 00:22
 */

namespace App\Classes\Server;

class ServerCommunicator {

    private $ftp_connector;
    private $ssh_connector;
    private static $instance;

    /**
     * the function for create instances of the class SshConnector
     * since this is a Singleton class
     */
    public static function getInstance(){
        if(null === static::$instance){
            static::$instance = new ServerCommunicator();
        }
        return static::$instance;
    }

    /**
     *private constructor
     */
    private function __construct(){

        $this->ssh_connector = SshConnector::getInstance();
        $this->ftp_connector = FtpConnector::getInstance();
    }

    /**
     * @param $user
     * @param $subject
     * @param $assignment
     *
     * go to the fucntion /user/subject/assginment
     * return true if success
     * return false if fail
     *
     * @return bool
     */
    public function go_to_directory($user,$subject,$assignment){

        $this->ftp_connector->go_to_home_folder();
        if($this->ftp_connector->change_directory_create_if_not_exist($user)){
            if($this->ftp_connector->change_directory_create_if_not_exist($subject)){
                if($this->ftp_connector->change_directory_create_if_not_exist($assignment)){
                    return true; // folders created successfully and directed in to the folder

                }
            }
        }
        return false;
    }

    /*
     * upload a file to /uesr/subject/assignment/
     */
    public function upload_file($user,$subject,$assignment,$file_path,$file_name){
        $this->go_to_directory($user,$subject,$assignment);
        return $this->ftp_connector->send_file($file_path,$file_name);
    }

    /*
     *  compile a python file in /user/subject/assignment/
     *  and return the results of compile
     */
    public function compile_a_file($user,$subject,$assignment,$file){
        $file_dir = "/$user/$subject/$assignment/";
        return $this->ssh_connector->compile_python($file_dir.$file);
    }

    /**
     * @param $command
     * @return mixed
     */
    public function execute_command($command){
        return $this->ssh_connector->execute_command($command);
    }

    /**
     * return true if compile time errors found
     * return false if successfully compiled
     * @param $user
     * @param $subject
     * @param $assignment
     * @param $file
     * @return bool
     */
    public function check_compile_error_java($user,$subject,$assignment,$file){

        return true;
    }
}