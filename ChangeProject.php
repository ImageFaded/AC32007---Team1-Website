<!-- Changes project data in the database. -->

<?php

include "dblink.php";

$con = connect();

//Gets data from UpdateProject.php
$id = $_POST['id'];
$name =  $_POST['projectName'];
$file = $_POST['projectFile'];
$description = $_POST['projectDescription'];

// Updates the database
$sql = "UPDATE projects SET ProjectName = '$name', ProjectFile = '$file', ProjectDescription = '$description' WHERE idProjects = $id";

if ($con->query($sql) === TRUE) {
    echo "Record edited successfully";
	unset($_GET['projectName']);
	header('Location: UpdateProject.php?done=yes&pjid='.$id);
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
mysqli_free_result($result);
mysqli_close($con);
?>