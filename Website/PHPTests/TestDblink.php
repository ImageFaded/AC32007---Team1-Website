<?php

require_once '..\dblink.php';

class TestDblink extends PHPUnit_Framework_Testcase{
    
    protected $link;
    
    protected function setUp(){
        //$this->link = new database();
    }
    
    protected function tearDown(){
        
    }
    
    public function testDblink1(){
        $database = new database();
        $this->assertTrue(true, $database);
    }
}
