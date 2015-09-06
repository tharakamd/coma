<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 11/08/2015
 * Time: 16:33
 */

namespace App\Classes\Server;


interface Compiler {

    public function compile_code($user,$course,$assignment,$file); // function to compile a single code
    public function execute_code($user,$course,$assignment,$file); // execute a single code
    public function get_source_code_list($user,$course,$assignment); // read source codes from the database
    public function compile_recursive($user,$course,$assignment); // compile codes recursively
}