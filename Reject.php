<?php
$id = $_GET['id'];

include "dblink.php";

$con = connect();

$sql = "UPDATE projects SET ProjectStatus = 3  WHERE idProjects = $id";

if ($con->query($sql) === TRUE) {
    echo "Record Updated";
	unset($_GET['id']);
	header('Location: PendingProjects.php?done=rejected');
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

?>