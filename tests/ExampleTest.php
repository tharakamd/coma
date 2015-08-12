<?php

class TestOne extends TestCase{


    public function test(){
     //   $response = $this->action('GET','CompileController@compile_test');
     //   $this->assertEquals('done',$response->getContent());

        $response = $this->action('GET','CompileController@upload_file');
        $this->assertEquals('done uploading',$response->getContent());

    }

    public function test_compile(){
        $response = $this->action('GET','CompileController@compile_file');
        $this->assertEquals("hello\n",$response->getContent());
    }


}