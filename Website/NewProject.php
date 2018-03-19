<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="en">

<head>
	<Title>New Project</Title>
	<link rel="stylesheet" href="FormStyle.css">
</head>

<h1>Submit New Project</h1><br><br><br>

<?php

//Displays alert if coming from AddProject.php.
//We add the file
//Also in form processing we want to store the name of the file in the database
include "dblink.php";

$database = connect();


if (isset($_GET['done']))
{
	echo"<script type='text/javascript'>alert('Project Successfuly Submitted');</script>";
	unset($_GET['done']);

}
	
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{



include "validate.php";


$projectName = $projectDes = "";
$ris = $_POST["ris"];
$id = $_SESSION["id"];

if (empty($_POST["projectName"]))
{
	//Throw up message
	//redirect
	
}
else
{
	$projectName = validate($_POST["projectName"]);
	
}


if (empty($_POST["projectDescription"]))
{
	//Throw up message
	//Ask if want description
	//If yes throw them back to original page
	//If not validate all the same
	$projectDes = validate($_POST["projectDescription"]);
}
else 
{
	$projectDes = validate($_POST["projectDescription"]);
}

//Check length of name and description

if ((strlen($projectName) > 50))
{
	//Return error
}

if ((strlen($projectDes) > 255))
{
	//return error
}


//File upload goes here
//Check if there exists a file
echo '<script>alert("I am about to handle")</script>';
if(!empty($_FILES['projectFile']))
{
	echo '<script>alert("There is a file")</script>';
	$targetDir = "uploads/";
	$sqlFilename = basename($_FILES["projectFile"]["name"]);
	$targetDir = $targetDir . basename($_FILES["projectFile"]["name"]);
	if(move_uploaded_file($_FILES['projectFile']['tmp_name'], $targetDir)) 
	{
		//Do all the rest of the processing
		$sql = 'INSERT INTO projects (projectName, projectDescription, projectStatus, projectFile, Researcher, RIS, Dean, ViceDean, RISApproved, ViceDeanApproved) VALUES ("'.$projectName.'", "'.$projectDes.'", 1, "'.$sqlFilename.'", "'.$id.'", "'.$ris.'", 10, 9, 1, 1)';
		if ($database->query($sql) === TRUE) 
		{
			echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/ViewCurrentProjects.php');</script>" ;
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $database->error;
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


}
?>

<!--Form for submission -->
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Project Name:<br>
 <input type="text" name="projectName" required><br><br>
File:<br>
 <input type="file" name="projectFile" required accept=".xls,.xlsx"><br><br>
 Project Description:<br>
 <textarea rows="10" cols="50" name="projectDescription" required></textarea><br><br>
RIS:<br>
<select name="ris">
<?php 

//Gets list of ris staff and puts them into a drop-down box.
$sql = "SELECT * FROM users WHERE position='RIS'";
 if ($result=mysqli_query($database,$sql))
    {

		while ($row=mysqli_fetch_row($result))
		{
			echo "<option value=".$row[0].">".$row[1]. " " . $row[2] . "</option>";
		}
		mysqli_free_result($result);
    }
	

?>        
</select>
<br><br>
<input type=submit value="Submit Project">
</form>



<br><br><br>
<form action="ViewCurrentProjects.php" method="post">
	<input type=submit id='move' value="View Projects">
</form>
<br><br><br>
<form action="staffPage.php" method="post">
	<input type=submit id='staffPage' value="Back">
</form>


