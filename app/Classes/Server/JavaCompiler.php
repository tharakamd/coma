<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 11/08/2015
 * Time: 16:39
 */

namespace App\Classes\Server;


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
     * @param $class
     * @return int
     */
    public function execute_code($user,$course,$assignment,$class,$test_cases){
        if($this->severCommunicatior->go_to_directory($user,$course,$assignment)) { // go to the directory in ftp
            $file_path = "srccodes/$user/$course/$assignment/$class"; // the full path of the class
            foreach($test_cases as $test_case => $output){// iterate through test cases

            }


        }
        return 0;
    }

}