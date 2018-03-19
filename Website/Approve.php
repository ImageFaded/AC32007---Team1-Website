<?php
//Changes the project status from 1 (pending) to 2 (approved). Still needs some system to make sure all three staff have approved before it is chenged.

// Gets ID of project to be approved from PendingProjects.php.
$id = $_GET['id'];

include "dblink.php";

////////////////////////////////////////////////////////
///Code goes here to check current (staff) user type///
//////////////////////////////////////////////////////

$UserType = "RIS";

$con = connect();

//Updates the database.


If ($UserType == "RIS")
{
	$sql = "UPDATE projects SET ProjectStatus = 5, RISApproved = 3 WHERE idProjects = $id";
	
	if ($con->query($sql) === TRUE) 
		{
			echo "Record Updated";
			unset($_GET['id']);
			header('Location: RISProjects.php?done=approved');
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $con->error;
		}
}
else If ($UserType == "ViceDean")
{
	$sql = "UPDATE projects SET ViceDeanApproved = 2  WHERE idProjects = $id";
	
	if ($con->query($sql) === TRUE) 
	{
		echo "Record Updated";
		unset($_GET['id']);
		header('Location: ViceDeanprojects.php?done=approved');
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}
else If ($UserType == "Dean")
{
	$sql = "UPDATE projects SET projectStatus = 2  WHERE idProjects = $id";

	if ($con->query($sql) === TRUE)
	{
		echo "Record Updated";
		unset($_GET['id']);
		header('Location: DeanProjects.php?done=approved');
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $con->error;
	}
}


?>