<!-- Changes project data in the database. -->

<?php

include "dblink.php";

$con = connect();

//Gets data from M.php
$id = $_GET['id'];;
$description = $_GET['projectDescription'];

// Updates the database
$sql = "UPDATE projects SET ProjectDescription = '$description', ProjectStatus = 1, RISApproved = 1 WHERE idProjects = $id";

if ($con->query($sql) === TRUE) {
    echo "Record edited successfully";
	unset($_GET['projectName']);
	header('Location: ViewCurrentProjects.php?done=yes&pjid='.$id);
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
mysqli_free_result($result);
mysqli_close($con);
?>