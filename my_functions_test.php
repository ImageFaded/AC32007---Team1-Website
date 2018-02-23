<?php

//Trying to test PHPUnit

class MyTest extends PHPunit_Framework_Testcase {

public function testAddition() {
	include('my_functions.php');
	$result = my_addition(1, 1);
	$this->assertEquals(2, $result);
}
}
?>