<!-- Changes project data in the database. -->

<?php
session_start();
include "dblink.php";
include "validate.php";

$database = connect();

//Gets data from UpdateProject.php
$id = $_SESSION["currentProject"];
$idUser = $_SESSION["id"];
$rank = $_SESSION["pos"];
if (isset($_POST['approveDeny']))
{
	$newStat = $_POST['approveDeny'];
}

if (empty($_POST["projectDescription"]))
{
	//Flag error
}
else 
{
	$description = validate($_POST["projectDescription"]);
}

$sql = 'SELECT ProjectStatus FROM projects WHERE idProjects = '.$id.';';
$result = mysqli_fetch_assoc(mysqli_query($database, $sql));
$updatedStatus = $result['ProjectStatus'];

switch($rank)
{ 	
	case "Researcher":
	break;
	case "RIS":
	if ($newStat == 'approve')
	{
		$updatedStatus = 2; //I t
	}
	if ($newStat == 'deny')
	{
		$updatedStatus = 3;
	}
	break;
	case "ViceDean":
	if ($newStat == 'approve')
	{
		$updatedStatus = 4;
	}
	if ($newStat == 'deny')
	{
		$updatedStatus = 3;
	}
		
	break;
	case "Dean":
	if ($newStat == 'approve')
	{
		$updatedStatus = 5;
	}
	if ($newStat == 'deny')
	{
		$updatedStatus = 3;
	}
	
	break;
}
//UPDATE status based off conditions

//User is RIS

//User is Vice-Dean

//User is Dean



// Updates the database
$sql = 'UPDATE projects SET ProjectDescription = "'.$description.'", ProjectStatus = '.$updatedStatus.' WHERE idProjects = '.$id.';';

if ($database->query($sql) === TRUE) {
    echo "Record edited successfully";
	$_SESSION["currentProject"] = "";
	header('Location: UpdateProject.php?done=yes&pjid='.$id);
	echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/staffpage.php');</script>" ;
} else {
    echo "Error: " . $sql . "<br>" . $database->error;
}
mysqli_close($database);
?>