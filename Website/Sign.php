<?php

include "dblink.php";

$con = connect();

$id = $_GET['pjid'];

// Updates the database
$sql = "UPDATE projects SET RISApproved = 2, ProjectStatus = 1 WHERE idProjects = $id";

if ($con->query($sql) === TRUE) {
    echo "Record signed successfully";
	unset($_GET['projectName']);
	header('Location: ViewCurrentprojects.php?signed=yes');
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
mysqli_free_result($result);
mysqli_close($con);
?>

