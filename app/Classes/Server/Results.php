<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 14/08/2015
 * Time: 09:03
 */

namespace App\Classes\Server;


use Monolog\Handler\StreamHandlerTest;

class Results {

    private $results = array(); // an array to store the test results
    private $status; // to store the status // false is compile error // true if compiled successfully
    private $name; // name of the source code

    /**
     * updates the status of the result
     * @param $status
     */
    public function __construct($status,$name){
        $this->status = $status;
        $this->name = $name;
    }

    /**
     * update the array , true if test case passes, false if fails
     * @param $status
     */
    public function add_next_result($status){
        array_push($this->results,$status);
    }

    /**
     * returns the results array
     * @return array
     */
    public function get_results(){
        return $this->results;
    }

    /**
     * return whether the code compiled successfully or not
     * @return mixed
     */
    public function is_compiled(){
        return $this->status;
    }

    /**
     * calculate marks and returns
     * @return int
     */
    public function get_marks(){
        if($this->status == false){ // if compilation error
            return 0;
        }else{
            $number_of_tests = count($this->results)*1.0; // number of test cases
            $number_of_passed_cases = 0; // number of passed test cases
            foreach ($this->results as $result) {
                if($result)
                    $number_of_passed_cases++;// if test passed then, increase the number of passed test cases
            }
            return $number_of_passed_cases/$number_of_tests;
        }
    }
}