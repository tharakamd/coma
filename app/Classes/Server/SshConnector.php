<?php

namespace App\Classes\Server;
class SshConnector {

    private static $instance;
    private $host = "192.168.16.128";
    private $user_name = "wbserver";
    private $pass_wd = "94fbrgts5610k";
    private $home_folder = "/home/wbserver/srccodes";
    private $ssh_connection;
    /**
     * the function for create instances of the class SshConnector
     * since this is a Singleton class
     */
    public static function getInstance(){
        if(null === static::$instance){
            static::$instance = new SshConnector();
        }


        return static::$instance;
    }

    /**
     *private constructor
     */
    private function __construct(){

        $this->connect_and_login();

    }

    /**
     *create a ssh connection
     * and log in to it
     */
    private function connect_and_login(){
        $this->ssh_connection = new \Net_SSH2($this->host);
        if($this->ssh_connection->login($this->user_name,$this->pass_wd))
            return true;
        return false;
    }

    /**
     * @param $command
     * @return mixed
     */
    public function execute_command($command){
        /** @var TYPE_NAME $this */
        return  $this->ssh_connection->exec($command);
    }


    /**
     * @param $command
     */

    public function execute_command_null_error($command){
        $this->connect_and_login();
        $this->ssh_connection->enableQuietMode();
        return $this->ssh_connection->exec($command);
    }

    public function get_last_error(){
        return $this->ssh_connection->getStdError();
    }

    /**
     * @param $location
     * @return mixed
     *
     * return true is succeded
     * return false in failure
     */
    public function direct_to_location($location){

        $out = $this->execute_command( 'cd '.$this->home_folder.$location);
        if($out == ""){ // if no error
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function get_directory(){
        return $this->execute_command("pwd");
    }

    public function compile_python($file){

        return $this->execute_command("python ".$this->home_folder.$file);
        // return $this->execute_command("./a.out");
    }


    /**
     * compile a .java file
     * returns the results of the compiler
     * @return bool
     */
    public function compile_java($file){
        return false;
    }


}