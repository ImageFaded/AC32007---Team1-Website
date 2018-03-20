<?php
//Takes data submitted from NewProject.php and inserts it into the database.
include "dblink.php";

$con = connect();
//session_start();

$FirstName =  $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Position = $_POST['Position'];

$sql = "INSERT INTO users (FirstName, LastName, Position) VALUES ('$FirstName', '$LastName', '$Position')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
	unset($_GET['projectName']);
	header('Location: NewProject.php?done=yes');
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}