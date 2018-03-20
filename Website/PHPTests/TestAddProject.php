<?php

require_once '..\AddProject.php';
class addUser{
    protected $link;
    
    protected function setUp(){
        $this->link = new testLogin();
    }
    
    protected function tearDown(){
        
    }
    
    public function testLogin(){
        $instance = new database();
        $details = "103891baca2751a856b094db796e3fee";
        $conn = $instance->connect();
        $sql = "SELECT idUsers, Position FROM users WHERE Username = '".$details."' AND Pass = '".$details."'";
        $result = mysqli_query($conn,$sql);
        $this->assert($result);
    }
}