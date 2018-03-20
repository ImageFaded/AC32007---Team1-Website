<?php
session_start();

echo '<script>alert("I start")</script>';

include "dblink.php";
include "validate.php";

$database = connect();

$projectName = $projectDes = "";
$RIS = $_POST["ris"];
$id = $_SESSION["id"];
echo '<script>alert("I am about to check")</script>';
if (empty($_POST["projectName"]))
{
	//Throw up message
	//redirect
	echo '<script>alert("Project name is empty!"</script>';
}
else
{
	$projectName = validate($_POST["projectName"]);
	echo '<script>alert("Project name is not empty!"</script>';
}

echo '<script>alert("I do check")</script>';

if (empty($_POST["projectDescription"]))
{
	//Throw up message
	//Ask if want description
	//If yes throw them back to original page
	//If not validate all the same
	echo '<script>alert("Project description is empty!"</script>';
	$projectDes = validate($_POST["projectDescription"]);
}
else 
{
	echo '<script>alert("Project description is not empty!"</script>';
	$projectDes = validate($_POST["projectDescription"]);
}

//File upload goes here
//Check if there exists a file
echo '<script>alert("I am about to handle")</script>';
if(!empty($_FILES['uploaded_file']))
{
	echo '<script>alert("There is a file")</script>';
	$targetDir = "uploads/";
	$target_file = $target_dir . basename($_FILES["projectFile"]["name"]);
	if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) 
	{
		//Do all the rest of the processing
		$sql = "INSERT INTO projects (projectName, projectDescription, projectStatus, projectFile, Researcher, RIS, Dean, ViceDean, RISApproved, ViceDeanApproved) VALUES ('$projectName', '$projectDes', 1, '$target_file', $id, $ris, 10, 9, 1, 1)";
		if ($database->query($sql) === TRUE) 
		{
			echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/ViewCurrentProjects.php');</script>" ;
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}
	else
	{
		//break everythng
	}
}
//File uploading code based on https://gist.github.com/taterbase/2688850





//pain ends here


//Get the new projects name and store it

//get the new projects description and store it

//Get the new projects file path and store it



//Use javascript to link back to all projects



?>