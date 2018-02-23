<!DOCTYPE html>
<!-- Allows the user to modify and existing project -->
<html lang="en">

<head>
	<Title>Modify Project</Title>
	<link rel="stylesheet" href="FormStyle.css">
</head>

<h1>Modify Project</h1><br><br><br>

<?php

//Displays alert if coming from UpdateProjects.php.
include "dblink.php";

$con = connect();


if (isset($_GET['done']))
{
	echo"<script type='text/javascript'>alert('Project Successfuly updated');</script>";
	unset($_GET['done']);

}

//Gets the ID of the project that the user selected.
$id = $_GET['pjid'];
echo $_GET['pjid'];

$sql = "SELECT * FROM projects WHERE idProjects = '$id'";

if ($result==mysqli_query($con,$sql))
{
	while ($row=mysqli_fetch_row($result))
	{
		$name = $row[1];
		$file = $row[3];
		$description = $row[4];
	}
}
mysqli_free_result($result);
mysqli_close($con);

?>

<!--Form for submission -->
<form action="ChangeProject.php?" method="get">
    ID:<br>
    <input type ="number" name="pjid" value="<?php echo $id;?>"required><br><br>
Project Name:<br>
 <input type="text" name="projectName" value="<?php echo $name; ?>"required><br><br>
File:<br>
 <input type="text" name="projectFile" value="<?php echo $file; ?>"required><br><br>
 Project Description:<br>
 <textarea rows="10" cols="50" name="projectDescription" required><?php echo $description; ?></textarea><br><br>
  <input type="hidden" name="id" value="<?php echo $id;?>"/>
 

<br><br>
<input type=submit value="Modify Project">



</form>
<br><br><br>
<form action="ViewCurrentProjects.php" method="get">
<input type=submit id='move' value="View Projects">
