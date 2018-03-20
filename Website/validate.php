<?php

function validate($data) //From https://www.w3schools.com/php/php_form_validation.asp
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>