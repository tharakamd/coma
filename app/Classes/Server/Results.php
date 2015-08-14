<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 14/08/2015
 * Time: 09:03
 */

namespace App\Classes\Server;


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
}