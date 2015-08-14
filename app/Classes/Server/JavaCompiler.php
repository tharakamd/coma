<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 11/08/2015
 * Time: 16:39
 */

namespace App\Classes\Server;

use DB;
class JavaCompiler {
    private static $instance;
    private $severCommunicatior;

    /**
     * the function for create instances of the class SshConnector
     * since this is a Singleton class
     */
    public static function getInstance(){
        if(null === static::$instance){
            static::$instance = new JavaCompiler();
        }


        return static::$instance;
    }

    private function __construct(){
        $this->severCommunicatior = ServerCommunicator::getInstance(); // creating a new server instances

    }

    /**
     * compile the given code and returns
     * true if successfully compiled
     * returns false otherwise
     * @param $user
     * @param $course
     * @param $assignment
     * @param $file
     * @return bool
     */
    public function compile_code($user,$course,$assignment,$file){
        if($this->severCommunicatior->go_to_directory($user,$course,$assignment)){ // go to the directory in ftp
            $file_path = "srccodes/$user/$course/$assignment/$file"; // the full path of the source code
            $result = $this->severCommunicatior->execute_command("javac $file_path"); // compiling the java source code
             if(strcmp($result,'')==0){ // if successfully compiled
                return true;
            }
         }
        return false;
    }

    /**
     * executes the given java class and test it with several test cases
     * returns the details of passed test cases
     * @param $user
     * @param $course
     * @param $assignment
     * @param $file
     * @return int
     * @internal param $class
     */
    public function execute_code($user,$course,$assignment,$file){
        $path = "~/srccodes/$user/$course/$assignment/"; // path where class and the test files are
        $length_of_name = strlen($file); // length of the name of the file
        $lenght_actual = $length_of_name - 5 ; // length without extention
        $class_name = substr($file,0,$lenght_actual); // name of the class
        $command = "cd $path && java $class_name"; // the command to execute
        return $this->severCommunicatior->execute_command($command); // execute the java class and returns the result
    }

    /**
     * read the database and returns an array of names of source codes of that particular assignment
     * @param $user
     * @param $course
     * @param $assignment
     * @return array
     */
    public function get_source_code_list($user,$course,$assignment){
        $codes = DB::select('select * from source_code WHERE user_name = ? and ass_id = ? and course_id = ?',array($user,$assignment,$course)); // read data from database
        $list = array();
        foreach($codes as $code){ // iterate through the source codes
            array_push($list,$code->name); // add code names to an array
        }
        return $list; // return the array
    }





}