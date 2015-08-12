<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 11/08/2015
 * Time: 16:33
 */

namespace App\Classes\Server;


class Compiler {
    private static $instance;
    private $javaCompiler;

    /**
     * the function for create instances of the class SshConnector
     * since this is a Singleton class
     */
    public static function getInstance(){
        if(null === static::$instance){
            static::$instance = new Compiler();
        }


        return static::$instance;
    }

    private function __construct(){
        $this->javaCompiler = JavaCompiler::getInstance(); // new java compiler
    }
    /**
     * compiles the source code according to the type
     * return true if successful compiles
     * return false otherwise
     * @param $user
     * @param $course
     * @param $assignment
     * @param $file
     * @param $type
     * @return bool
     */
    public function compile($user,$course,$assignment,$file,$type){
        if($type == 'java'){ // if java code found
           return $this->javaCompiler->compile_code($user,$course,$assignment,$file);
        }
        return false;
    }
}