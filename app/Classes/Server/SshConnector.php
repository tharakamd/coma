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
     * remove the give n folder in the given directory
     * @param $dir
     * @param $folder
     * @return mixed
     */
    public function delete_folder($dir,$folder){
        $command = "cd $dir && rm -r $folder"; // go the the directory and remove recursively
        return $this->execute_command($command);
    }

    /**
     * delete a file in the given directory
     * @param $file_dir
     * @param $file
     * @return mixed
     */
    public function delete($file_dir,$file){
        return $this->execute_command("cd $file_dir && rm $file");
    }

    /**
     * unzip file on the current directory
     * @param $file
     * @return mixed
     */
    public function unzip($file_dir,$file){
        return $this->execute_command("cd $file_dir && unzip -o $file");
    }

    /**
     * first go the the base directory
     * then copy the source file in the destination file
     * @param $base_dir
     * @param $source
     * @param $destination
     * @return mixed
     */
    public function copy_file($base_dir,$source,$destination){
        $command = "cd $base_dir && cp -f $source $destination "; // the command to run
        return $this->execute_command($command); // executing the command
    }


}