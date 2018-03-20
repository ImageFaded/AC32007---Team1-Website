<!DOCTYPE html>
<!-- Allows the user to modify and existing project -->
<html lang="en">

<head>
	<Title>Modify Project</Title>
	<link rel="stylesheet" href="FormStyle.css">
</head>

<h1>Modify Project</h1><br><br><br>

<?php

//This section of code sends takes the user and checks if there valid to view this. If not it sends them to a watery grave

//We need to know what project we are updating
	session_start();
	include "dblink.php";
	$projId = $_GET['number'];
	$database = connect();
	if (($_SESSION["pos"] == "Researcher") || ($_SESSION["pos"] == "RIS"))
	{
		//Check if they are valid
		$sql = 'SELECT Researcher, RIS FROM projects WHERE idProjects = '.$projId.'';
		$result = mysqli_fetch_assoc(mysqli_query($database, $sql));
		
		if (($result['Researcher'] != $_SESSION["id"]) && ($result['RIS'] != $_SESSION["id"]))
		{
			//Throw them back to staff page
			echo '<script>alert("YOU ARE BAD!")</script>';
			echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/staffpage.php');</script>" ;
		}
		else
		{
			$_SESSION["currentProject"] = $projId;
			$sql = 'SELECT * FROM projects WHERE idProjects = '.$projId.'';
			$result = mysqli_fetch_assoc(mysqli_query($database, $sql));
			$name = $result['ProjectName'];
			$status = $result['ProjectStatus'];
			$Description = $result['ProjectDescription'];
			$Researcher = $result['Researcher'];
			$RIS = $result['RIS'];
			
			
		}
		
	}
	else
	{
		//I am a dean or a vice dean;
		$_SESSION["currentProject"] = $projId;
		$sql = 'SELECT * FROM projects WHERE idProjects = '.$projId.'';
		$result = mysqli_fetch_assoc(mysqli_query($database, $sql));
		$name = $result['ProjectName'];
		$status = $result['ProjectStatus'];
		$Description = $result['ProjectDescription'];
		$Researcher = $result['Researcher'];
		$RIS = $result['RIS'];
	}
	//Check the rank
	

?>
<form action="ChangeProject.php?" method="post">

Project Description:<br>
<input type="text" name="projectDescription" value="<?php echo $Description; ?>"required><br><br>
 
 <?php

 
 //if you are IRS or Vice Dean and it is above your approval disable and display message
 
 //If you are Vice Dean or Dean and it is bellow your approval display warning
 
 if ((($_SESSION["pos"] == "ViceDean") && ($status = 1)) || (($_SESSION["pos"] == "Dean") && (($status <= 2))))
 {
	 echo "This project has not been approved by RIS or the Vice Dean. Approving this may be against university policy <br>";
 }
 
 
 
 //Prints out the buttons if you can accept and deny
 if ($_SESSION["pos"] != "Researcher") 
     {
        echo '<input type="radio" name="approveDeny" value="approve"required> Approve <br><input type="radio" name="approveDeny" value="deny"required> Deny     <br><input type="radio" name="approveDeny" value="pending"required> Pending <br>';
        //Since its been viewed by a senior member we can set unread to one
        $sql2 = 'UPDATE projects SET unread = 1 WHERE idProjects = '.$projId.';';
        mysqli_query($database, $sql2);
     }

 ?>
 
<input type="submit" value="Edit">

</form> 
 
 <?php
 
  if ($_SESSION["pos"] == "Researcher") {echo '  <button onclick="Destroy()">Delete Project</button> ';}
 
 ?>
 
<script>
function Destroy()
{
	if (confirm("Do you wish to delete this project. This cannot be undone."))
	{
		if (confirm("Are you sure. This cannot be undone."))
		{
			window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/deleteProject.php');
		}
	}
}
</script>


<br><br><br>
<form action="staffPage.php" method="post">
	<input type=submit id='staffPage' value="Back">
</form>