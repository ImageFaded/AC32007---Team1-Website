<?php
//Changes the project status from 1 (pending) to 2 (approved). Still needs some system to make sure all three staff have approved before it is chenged.

// Gets ID of project to be approved from PendingProjects.php.
$id = $_GET['id'];

include "dblink.php";

$con = connect();

//Updates the database.
$sql = "UPDATE projects SET ProjectStatus = 2  WHERE idProjects = $id";

if ($con->query($sql) === TRUE) {
    echo "Record Updated";
	unset($_GET['id']);
	header('Location: PendingProjects.php?done=approved');
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

?>