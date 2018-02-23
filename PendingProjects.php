<!-- Displays all pending projects stored in database in tabular form -->
<Head>
<Title>projects Awaiting Approval</Title>
</Head>
<Body id=mainpage>
<link rel="stylesheet" href="FormStyle.css">
<h1>Current Projects</h1><br><br>
<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>File</th>
<th>Status</th>
<th>Description</th>
<th>Researcher</th>
<th>RIS</th>
<th>Vice Dean</th>
<th>Dean</th>
<th>Approve</th>
<th>Reject</th>
</tr>


<?php
//Displays message if project ahs just been approved or denied.

if (isset($_GET['done']))
{
	if (($_GET['done']) == "approved")
	{
		echo"<script type='text/javascript'>alert('Project Approved');</script>";
		unset($_GET['done']);
	}
	else if (($_GET['done']) == "rejected")
	{
		echo"<script type='text/javascript'>alert('Project Rejected');</script>";
		unset($_GET['done']);
	}
		

}

//Code should go here that checks whether the crrent user is RIS, Vice Dean or Dean.
include "dblink.php";

$con = connect();
$sql = "SELECT * FROM projects WHERE ProjectStatus = 1";
		
//Join allows page to display name of staff instead of ID. 
$sql2 = "SELECT FirstName, LastName FROM users INNER JOIN projects ON users.idUsers = projects.Researcher;";
$sql3 = "SELECT FirstName, LastName FROM users INNER JOIN projects ON users.idUsers = projects.RIS;";
$sql4 = "SELECT FirstName, LastName FROM users INNER JOIN projects ON users.idUsers = projects.ViceDean;";


	//Displays the details of all pending research projects in the database. 
    if ($result=mysqli_query($con,$sql))
    {
		$nameResult=mysqli_query($con,$sql2);
		$risResult=mysqli_query($con,$sql3);
		$vicedeanResult=mysqli_query($con,$sql4);
		
		echo "<tr>";
		
		while ($row=mysqli_fetch_row($result))
		{
			$names=mysqli_fetch_row($nameResult);
			$RIS=mysqli_fetch_row($risResult);
			$viceDean = mysqli_fetch_row($vicedeanResult);
			
			$id = $row[0];
			$status = $row[2];
			$description = $row[4];
			
			if ($status == 1)
			{
				$textStatus = "Pending";
			}
			else if ($status == 2)
			{
				$textStatus = "Approved";
			} 
			else if ($status == 3)
			{
				$textStatus = "Denied";
			} 
			
			echo "<td>" . $id . "</td>";
			echo "<td>" . $row[1] ."</td>";
			echo "<td>" . $row[3] ."</td>";
			echo "<td>" . $textStatus . "</td>";
			echo "<td>" . $description . "</td>";
			echo "<td>" . $names[0] . " " . $names[1]. "</td>";
			echo "<td>" . $RIS[0] . " " . $RIS[1]. "</td>";
			echo "<td>Iain Stewart</td>";
			echo "<td>" . $viceDean[0] . " " . $viceDean[1] ."</td>";
			echo "<td><a href='Approve.php?id=$id'>Approve</a></td>";
			echo "<td><a href='Reject.php?id=$id'>Reject</a></td>";
			
			
			echo "</tr>";
		
		}
		

		mysqli_free_result($result);
		mysqli_free_result($nameResult);
		mysqli_free_result($risResult);
		mysqli_free_result($vicedeanResult);
    }
	
	
    mysqli_close($con);
	

?>
</table>
</Body>


<br><br>

<form action="NewProject.php" method="post">
<input type=submit id='move' value="Submit a Project">