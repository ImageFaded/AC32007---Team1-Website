<!DOCTYPE html>
<!-- Allows the user to sumbit a new project -->
<!--TODO: File submission, get researcher from logged in user. -->
<html lang="en">

<head>
	<Title>New Project</Title>
	<link rel="stylesheet" href="FormStyle.css">
</head>

<h1>Submit New Project</h1><br><br><br>

<?php

//Displays alert if coming from AddProject.php.
include "dblink.php";

$con = connect();


if (isset($_GET['done']))
{
	echo"<script type='text/javascript'>alert('Project Successfuly Submitted');</script>";
	unset($_GET['done']);

}
	
?>

<!--Form for submission -->
<form action="AddProject.php" method="post">
Project Name:<br>
 <input type="text" name="projectName" required><br><br>
File:<br>
 <input type="text" name="projectFile" required><br><br>
 Project Description:<br>
 <textarea rows="10" cols="50" name="projectDescription" required></textarea><br><br>
 
 Researcher<br>
<select name="researcher">

<?php 
//Gets list of researchers and puts them into a drop-down box.
$sql = "SELECT * FROM users WHERE position='Researcher'";
 if ($result=mysqli_query($con,$sql))
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
 RIS:<br>
<select name="ris">

<?php 

//Gets list of ris staff and puts them into a drop-down box.
$sql = "SELECT * FROM users WHERE position='RIS'";
 if ($result=mysqli_query($con,$sql))
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


