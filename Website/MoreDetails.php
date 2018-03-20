<!DOCTYPE html>
<!-- Allows the user to add more details to a project. -->
<html lang="en">

<head>
	<Title>Add Details</Title>
	<link rel="stylesheet" href="FormStyle.css">
</head>

<h1>Add Details</h1><br><br><br>

<?php

//Displays alert if coming from UpdateProjects.php.
include "dblink.php";

$con = connect();


//Gets the ID of the project that the user selected.
$id = $_GET['pjid'];

$sql = "SELECT * FROM projects WHERE idProjects = '$id'";

if ($result=mysqli_query($con,$sql))
{
	while ($row=mysqli_fetch_row($result))
	{
		$description = $row[4];
	}
}
mysqli_close($con);

?>

<!--Form for submission -->
<form action="DetailsAdded.php?" method="get">
 Project Description:<br>
 <textarea rows="10" cols="50" name="projectDescription" required><?php echo $description; ?></textarea><br><br>
  <input type="hidden" name="id" value="<?php echo $id;?>"/>
 

<br><br>
<input type=submit value="Modify Project">


</form>
<br><br><br>
<form action="ViewCurrentProjects.php" method="get">
<input type=submit id='move' value="View Projects">
