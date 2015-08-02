<?php

namespace App\Classes\Server;
class FtpConnector {
    private static $instance;


    /*
     *  variables regarding the ftp connection
     */
    private $host = "192.168.16.128";
    private $user_name = "wbserver";
    private $port = 21;
    private $pass_wd = "94fbrgts5610k";
    private $home_folder = "srccodes";
    private $ftp_connection;
    private $ftp_session;

    /**
     * the function for create instances of the class FTpConnector
     * since this is a Singleton class
     */
    public static function getInstance(){
        if(null === static::$instance){
            static::$instance = new FtpConnector();
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
     * creates a new ftp connection
     * log in to the created connection
     * returns false if something wend wrong
     * returns true if succeeded in both processes
     * @return boolean
     */
    public function connect_and_login(){
        $this->ftp_connection = ftp_connect($this->host,$this->port);
        if($this->ftp_connection){
            // connection created successfully
            $this->ftp_session = ftp_login($this->ftp_connection,$this->user_name,$this->pass_wd);
            if($this->ftp_session)
                return true;
        }
        return false;
    }


    /**
     * close the ftp connection
     */
    public function close_connection(){
        ftp_close($this->ftp_connection);
    }


    /**
     * @param $folder_name
     * public function which creates a folder in the server
     * in this function the folder name is supposed to be in the good format
     * @return boolean
     */
    public function create_folder($folder_name){
        if(ftp_mkdir($this->ftp_connection,$this->home_folder.$folder_name)){
            return true;
        }
    }

    /*
     * creates a folder in the current directory
     */
    public function create_folder_in_pwd($folder){
        return ftp_mkdir($this->ftp_connection,$folder);
    }

    /**
     * @param $directory
     * if the folder is exist then go to it and return true
     * else return false
     * @return bool
     */
    public function change_directory_if_exist($directory){
        return @ftp_chdir($this->ftp_connection,$directory);
    }

    /**
     * @return bool
     */
    public function go_to_home_folder(){
        $this->close_connection();
        $this->connect_and_login();
        return $this->change_directory_if_exist($this->home_folder);
    }

    /**
     * @param $directory
     * @return bool
     */
    public function change_directory_create_if_not_exist($directory){
        if($this->change_directory_if_exist($directory)){
            return true;
        }else{
            if($this->create_folder_in_pwd($directory)){
                if($this->change_directory_if_exist($directory)){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $directory
     * @return bool
     */
    public function change_directory_create_if_not_exist_in_home($directory){
        if($this->change_directory_if_exist($directory)){
            return true;
        }else{
            if($this->create_folder($directory)){
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     * go to the parent directory
     * return true if success
     * return false if fail
     */
    public function go_to_parent_directory(){
        return @ftp_cdup($this->ftp_connection);
    }


    /**
     * @return bool
     * returns the current working directory
     */
    public function get_pwd(){
        return ftp_pwd($this->ftp_connection);
    }

    /**
     * @param $local_file_name
     * @param $remote_file_name
     * @return bool
     * create a file in ftp server
     *
     * create a file in ftp server
     * the folder should have been created already
     * @internal param $file_name
     * @internal param $directory
     */
    public function send_file($local_file_name,$remote_file_name){
        if(@ftp_put($this->ftp_connection,$remote_file_name,$local_file_name,FTP_BINARY)){
            return true;
        }
        return false;
    }

    /**
     * @param $local_file
     * @param $remote_file
     * @return bool
     *
     *  send file with same name of the local file
     */
    public function send_file_same_name($local_file,$remote_file){
        return $this->send_file($local_file,$remote_file);
    }

    /**
     * @param $local_file
     * @param $remote_floder
     * @param $remote_file
     *
     * @return bool
     *
     * send file with different name with the local file
     */
    public function send_file_dif_name($local_file,$remote_floder,$remote_file){
        return $this->send_file($local_file,$remote_floder.$remote_file);
    }

}