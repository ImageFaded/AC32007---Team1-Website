<!-- Code to test if database info shows up in PHP (Aimee) -->

<?php
//namespace phpUnitTutorial\Test;

	//Connects to database
            

    include "dblink.php";

    $con = connect();
	
		

    $sql = "SELECT * FROM users";
	
	

    //Displays details of all users in database
    if ($result=mysqli_query($con,$sql))
    {
		while ($row=mysqli_fetch_row($result))
		{
			//printf ("%s (%s)\n",$row[0],$row[1]);
			echo ("ID: ".$row[0] ." &nbsp;&nbsp;&nbsp;Name: " . $row[1] . "       " . $row[2] . "&nbsp&nbsp;&nbsp;Position: " . $row[3] . "<br>");
		}
		// Free result set
		mysqli_free_result($result);
    }
	
	    $sql = "SELECT * FROM projects";
		
		//Join allows page to display name of researcher instead of foreign key. Didn't bother to join the others.
		$sql2 = "SELECT LastName FROM users INNER JOIN projects ON users.idUsers = projects.Researcher;";
	
	

	//Displays the details of all the research projects in the database. 
    if ($result=mysqli_query($con,$sql))
    {
		$nameResult=mysqli_query($con,$sql2);
		
		echo "<br><br><br>";

		while ($row=mysqli_fetch_row($result))
		{
			$names=mysqli_fetch_row($nameResult);
			//printf ("%s (%s)\n",$row[0],$row[1]);
			echo ("ID: ".$row[0] ." &nbsp;&nbsp;&nbsp;Name: " . $row[1]  . "&nbsp&nbsp;&nbsp;File: " . $row[2] . "&nbsp&nbsp;&nbsp;Status: " . $row[3] . "&nbsp&nbsp;&nbsp;Researcher: " . $names[0] . "&nbsp&nbsp;&nbsp;RID: " . $row[5] . "&nbsp&nbsp;&nbsp;Dean: " . $row[6] . "&nbsp&nbsp;&nbsp;Vice Dean: " . $row[7] . "<br>");
		}
		// Free result set
		mysqli_free_result($result);
		mysqli_free_result($nameResult);
    }
	
	
    mysqli_close($con);

		

		
	

    ?>