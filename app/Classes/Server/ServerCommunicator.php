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

    /**
     * go the the folder starting from the assignment folder
     * @param $user
     * @param $subject
     * @param $assignment
     * @param $special_folder
     * @return bool
     */
    public function go_to_directory_special($user,$subject,$assignment,$special_folder){
        $this->ftp_connector->go_to_home_folder();
        if($this->ftp_connector->change_directory_create_if_not_exist($user)){
            if($this->ftp_connector->change_directory_create_if_not_exist($subject)){
                if($this->ftp_connector->change_directory_create_if_not_exist($assignment)){
                    if($this->ftp_connector->change_directory_create_if_not_exist($special_folder)) {
                        return true; // folders created successfully and directed in to the folder
                    }
                }
            }
        }
        return false;
    }

    /**
     * upload the code zip file in the the relevant folder
     * unzip the file
     * delete zip file
     * @param $user
     * @param $subject
     * @param $assignment
     * @param $file_path
     * @param $file_name
     */
    public function upload_code_zip($user,$subject,$assignment,$file_path){
        $file_name = 'codes.zip'; // this is used as the file name for the zip file
        $this->upload_file($user,$subject,$assignment,$file_path,$file_name); // uploading the zip file in the remote server
        $file_dir = "~/srccodes/$user/$subject/$assignment/" ; // the file directory in remote server
        $this->ssh_connector->unzip($file_dir,$file_name); // unziping the file
        $this->ssh_connector->delete($file_dir,$file_name); // deleting the file
        return true;
    }
    /*
     * upload a file to /uesr/subject/assignment/
     */
    public function upload_file($user,$subject,$assignment,$file_path,$file_name){
        $this->go_to_directory($user,$subject,$assignment);
        return $this->ftp_connector->send_file($file_path,$file_name);
    }

    public function upload_file_special($user,$subject,$assignment,$special_folder,$file_path,$file_name){
        $this->go_to_directory_special($user,$subject,$assignment,$special_folder);
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
     * @param $user
     * @param $course
     * @param $assignment
     */
    public function unzip_and_delete_test_files($user,$course,$assignment){
        $file_dir = "~/srccodes/$user/$course/$assignment/testCases"; // the target directory
        $file = "testFiles.zip"; // the target file
        $this->ssh_connector->unzip($file_dir,$file); // unziping the file
        return $this->ssh_connector->delete($file_dir,$file); // deleting the file

    }

    /**
     * delete a given assignment folder from remote server
     * @param $user
     * @param $course
     * @param $assignment
     */
    public function delete_assignment($user,$course,$assignment){
        $dir = "~/srccodes/$user/$course"; // the directory where the folder is in
        $this->ssh_connector->delete_folder($dir,$assignment); // remove the assignment directory
    }

    /**
     *
     * remove the given course directory
     * @param $user
     * @param $course
     */
    public function delete_course($user,$course){
        $dir = "~/srccodes/$user"; // go to the directory
        $this->ssh_connector->delete_folder($dir,$course); // remove the course directory
    }

    /**
     * delete the file at the given assignment folder
     * @param $user
     * @param $course
     * @param $assignment
     * @param $file
     * @return mixed
     */
    public function delete_file($user,$course,$assignment,$file){
        $file_dir = "~/srccodes/$user/$course/$assignment"; // directory of the file
        return $this->ssh_connector->delete($file_dir,$file); // deleting the file
    }

    /**
     * returns an array of files with the given type in the assignment folder
     * @param $user
     * @param $course
     * @param $assignment
     * @param $type
     */
    public function get_file_list($user,$course,$assignment,$type){
        $folder_dir = "~/srccodes/$user/$course/$assignment"; // the assignment directory
        $command = "cd $folder_dir && find *$type"; // the command to execute
        $output = $this->execute_command($command); // execute command to find files
        $list = explode($type,$output); // split by new line characters
        $final_list = array();
        foreach($list as $list_items){ // updating the list with file types
            $list_items = trim($list_items.$type);
            array_push($final_list,$list_items);
        }
        unset($final_list[sizeof($final_list)-1]); // removing the last element of the array
        return $final_list; // returns the list
    }

    /**
     * copy the given test code to the source code directory
     * @param $user
     * @param $course
     * @param $assignment
     * @param $test_number
     * @return mixed
     */
    public function copy_test_file($user,$course,$assignment,$test_number){
        $base_dir = "~/srccodes/$user/$course/$assignment/"; // the base directory for the files
        $source_file = "testCases/$test_number.txt"; // the location of the current test file
        $destination_file = "test.txt";
        return $this->ssh_connector->copy_file($base_dir,$source_file,$destination_file); // copying the file
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

    /**
     * reads the string and returns an array with csv results
     * @param $input
     * @return array
     */
    public function read_csv($input){
        return str_getcsv($input);
    }

    /**
     * reads the relevent csv file and returns the file as a string
     * @param $user
     * @param $course
     * @param $assignment
     * @return mixed
     */
    public function read_csv_file($user,$course,$assignment){
        $csv_file_path = "~/srccodes/$user/$course/$assignment/testResults"; // the csv file path
        $csv_file = "testResult.csv";
        $command = "cd $csv_file_path && cat $csv_file"; // command to read the file
        return $this->execute_command($command); // execute and return the result
    }

    /**
     * read the csv file and returns the content as an array
     * @param $user
     * @param $course
     * @param $assignment
     * @return array
     */
    public function get_csv_as_array($user,$course,$assignment){
        return $this->read_csv($this->read_csv_file($user,$course,$assignment));
    }
}
