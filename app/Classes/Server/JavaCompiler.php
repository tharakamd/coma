<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 11/08/2015
 * Time: 16:39
 */

namespace App\Classes\Server;

use DB;
use App\Classes\Server\Results;
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

    /**
     *
     */
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

    /**
     * compile codes recursively and returns results as an array of Results objects
     * @param $user
     * @param $course
     * @param $assignment
     * @return array
     */

    /*
     * compile recursively and returns array of results
     */
    public function compile_recursive($user,$course,$assignment){
        $codes = $this->get_source_code_list($user,$course,$assignment); // the source code list to compile
        $results = array(); // array to store the results
        $test_results = $this->severCommunicatior->get_csv_as_array($user,$course,$assignment); // get the test result array
        foreach ($codes as $code) { // iterate through codes
            if($this->compile_code($user,$course,$assignment,$code)){ // if code compiled
                $code_result = new Results(true,$code); // new result instant, successfully compiled
                $test_number = 1; // the number of the current test file
                foreach($test_results as $test_result){ // iterate through the test cases
                        $this->severCommunicatior->copy_test_file($user,$course,$assignment,$test_number); // moving the test files
                        $execution_output = $this->execute_code($user,$course,$assignment,$code); // execute the code
                        if(strcmp($execution_output,$test_result) == 0){ // if test passes
                            $code_result->add_next_result(true); // this test case passes
                        }else{
                            $code_result->add_next_result(false); // this test case fails
                        }
                    $test_number++; // increase the test number
                }
                array_push($results,$code_result); // add new element to array with resutls
            }else{// if compilation error
                array_push($results,new Results(false,$code)); // add new element to array with status false
            }
        }

        return $results;
    }


}