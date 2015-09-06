<?php
/**
 * Created by PhpStorm.
 * User: Dilan
 * Date: 06/09/2015
 * Time: 23:30
 */

namespace App\Classes\Server;
use App\Classes\Server\Compiler;
use App\Classes\Server\JavaCompiler;

class CompilerFactory {

    public static function createCompiler($type){

        switch($type){
            case "java":
                return JavaCompiler::getInstance();
        }
    }
}