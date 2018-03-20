<!-- Displays all projects stored in database in  tabular form -->
<?php
	session_start();  
	//echo "<script>alert(".$_SESSION['id'].")</script>"
?>

<Head>
<Title>Current Projects</Title>
</Head>
<Body id=mainpage>
<link rel="stylesheet" href="FormStyle.css">
<h1>Current Projects</h1><br><br>

<form action="ViewCurrentProjects.php" method="get">

<select name="orderBy">
<option value="1">Status</option>
<option value="2">Name</option>
<option value="3">Resercher</option>
<option value="4">RIS</option>
<option value="5">Date Created</option>

<input type=submit id='Sort' value="Sort">

<input type="hidden" name="pageType" value="<?php echo $_GET['pageType']; ?>">

</form>

<table>

<tr>
<th>Name</th>
<th>File</th>
<th>Status</th>
<th>Description</th>
<th>Researcher</th>
<th>RIS</th>
<th>Vice Dean</th>
<th>Dean</th>
<th>Update Project</th>
<th>Date Created</th>
</tr>


<?php

//Get the user type from the database
//CASE
$id = $_SESSION["id"];
//gets the user ID
//Now we get the rank of the user 
include "dblink.php";
$database = connect();
$sql = 'SELECT position FROM users WHERE idUsers = '.$id.';';
$result = mysqli_query($database, $sql);
$row = mysqli_fetch_assoc($result);
$rank = $row['position'];

//Code Refactored
switch($rank)
{ 	
	case "Researcher":
		//Do the sql for resercher
		//$sql = 'SELECT Position FROM projects WHERE Researcher = '.$_SESSION["id"].'';
		//get project data for where I am a resercher
		//Display them
		display(1);
		break;
	case "RIS":
		//Do the sql for RIS
		//$sql = 'SELECT * FROM projects WHERE RIS = '.$id.'';
		//get the project data for where I am RIS
		//Display them
		display(2);		
		break;
	case "ViceDean":
		display(3);		
		break;
	case "Dean":
		display(3);
		break;
}



//Researcher display all projects where I am a reserhcer
//RIS display all projects where I am the specified RIS
//Dean/ViceDean display all projects

if (isset($_GET['signed']))
{
	if (($_GET['signed']) == "yes")
	{
		echo"<script type='text/javascript'>alert('Signed');</script>";
		unset($_GET['signed']);
	}

}

if (isset($_GET['done']))
{
	echo"<script type='text/javascript'>alert('Project Successfuly Submitted');</script>";
	unset($_GET['done']);

}
	
//select dean
//Code Refactored
function display($a)
{
	$sortey = 0;
	if (isset($_GET['pageType']))
	{
		$sortey = $_GET['pageType'];
	}
	//Checks if you are logged in
	if (isset($_SESSION["id"])){
		$id = $_SESSION["id"];
	} else { 
		echo '<script>alert("Not logged in!")</script>';
	};
	
	//Connects to the database
	
	$database = connect();
	
	//Based off rank does diffrent select statement
	
	switch($a){
		case 1:
			$sql = 'SELECT * FROM projects INNER JOIN users ON users.idUsers = Researcher WHERE Researcher = '.$id.'';
			break;
		case 2:
		    $sql = 'SELECT * FROM projects INNER JOIN users ON users.idUsers = RIS WHERE RIS = '.$id.'';
			break;
		case 3:
			$sql = "SELECT * FROM projects";
			break;
		case 4:
			$sql = "SELECT * FROM projects";
			break;
		
	}
	
        if (isset($_GET['orderBy']))
        {
            switch($_GET['orderBy']) 
            {
                case 1:
                    $sql = $sql." ORDER BY ProjectStatus";
                    break;
                case 2:
                    $sql = $sql." ORDER BY ProjectName";
                    break;
                case 3:
                    $sql = $sql." ORDER BY Researcher";
                    break;
                case 4:
                    $sql = $sql." ORDER BY RIS";
                    break;
                
                case 5:
                    $sql = $sql." ORDER BY DateCreated";
                    break;
                
            }  
        }
        $result = mysqli_query($database, $sql);

	
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<tr>";
		//Processing
		//Get RIS, Dean and Vice Deans name
		$name =	$File = $Status = $Description = $Researcher = $RIS = $ViceDean = $Dean = "";
		
		$name = $row['ProjectName'];
		
		$File = '<a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/uploads/'.$row['ProjectFile'].'" download> '.$row['ProjectFile'].' </a>';
		
		//Converts numberical status into a text statement describing the satus fo the project
		$status = $row['ProjectStatus'];	

		switch($status){
			case 1:
				$textStatus = "Pending";
				break;
			case 2:
				$textStatus = "Approved";
				break;
			case 3: 
				$textStatus = "Denied";
				break;
			case 4:
				$textStatus = "Vice Dean approved";
				//$linkText = "Change Details";
				//$link = "<a href='moreDetails.php?pjid=$id'>";
				break;
			case 5:
				$textStatus = "Dean approved";
				//$linkText = "Sign";
				//$link = "<a href='sign.php?pjid=$id'>";
				break;
		}

		$Description = $row['ProjectDescription'];
		
		//This depends on what kind of user is logged in
		switch($a){
			case 1:
			//I am a resercher. You already have my first and last name
			$Researcher = "".$row['FirstName']." ".$row['LastName']."";
			$RIS = nameMaker($row['RIS']);
			
			break;
			
			//I am a RIS. This means I have access to the RIS name
			
			case 2:
			//I am a RIS. This means I have access to the RIS name
			$RIS = "".$row['FirstName']." ".$row['LastName']."";
			//For resercher you must get my first name and last name from the database
			$Researcher = nameMaker($row['Researcher']);
			

			break;
			
			
			
			
			case 3:
			//I am a Vice Dean OR DEAN. This means I have access to the Vice dean name
			$Researcher = nameMaker($row['Researcher']);
			//For resercher you must get my first name and last name from the database
			$RIS = nameMaker($row['RIS']);
			
			//Do the same for Vice Dean
			


		}
		
		
		$ViceDean = nameMaker($row['ViceDean']);

		$Dean = nameMaker($row['Dean']);
		
		$number = $row['idProjects'];
		
		$unread = $row['unread'];
                $date = $row['DateCreated'];
		
		//$Update = $link = "<a href='UpdateProject.php?pjid=$id'>";
		
		if (($sortey == 0) || (($sortey == 1) && ($status == 1)) || (($sortey == 2) && ($status == 5)) || (($sortey == 3) && ($unread == 0))  )
		{
			echo "<td>".$name."</td>";
			echo "<td>".$File."</td>";
			echo "<td>".$textStatus."</td>";
			echo "<td>".$Description."</td>";
			echo "<td>".$Researcher."</td>";
			echo "<td>".$RIS."</td>";
			echo "<td>".$ViceDean."</td>";
			echo "<td>".$Dean."</td>";
			echo '<td> <a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/newUpdate.php?number='.$number.'"> All Projects</td>';
                        echo "<td>".$date."</td>";
		}
		
		echo "</tr>";
		
		//Displaying
		
	}
}



function nameMaker($who)
{
	$database = connect();
	$sql3 = 'SELECT FirstName, LastName FROM users WHERE idUsers = '.$who.';';
	$result2 = mysqli_query($database, $sql3);
	while($rowNew = mysqli_fetch_assoc($result2))
	{
		//Will only ever have one result
		$name = "".$rowNew['FirstName']." ".$rowNew['LastName']."";
	}
	return $name;
}

	
//genericDsplay()
//{
	//Will display everything that get 
//}
	
	
?>
</table>
</Body>


<br><br>


<br><br><br>
<form action="staffPage.php" method="post">
	<input type=submit id='staffPage' value="Back">
</form>

