<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="FormStyle.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Login</h1></br></br>
        

<?php
      
//clean inputs
$Username = $Password = "";
      
if ($_SERVER["REQUEST_METHOD"] == "POST" )
{           
	include 'validate.php';
	include 'dblink.php';
	$Username = validate($_POST["Username"]);
	$Password = hash ("md5" , validate($_POST["Password"]));
	//Connect to database and input data 
	$database = connect();
	$sql = "SELECT idUsers, Position FROM users WHERE Username = '".$Username."' AND Pass = '".$Password."'";
	$result = mysqli_query($database, $sql);
	//If there are no results that match
	if (mysqli_num_rows($result)==0)
	{
		echo "Login Failed";
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			//will only repeat once cause it will only ever fetch one result
			// Start the session
			//$seshpath = "c:\\websites\\2017-agile\\team1\\uploads";
			//echo $seshpath;
			//echo "<br/>";
			//echo session_save_path();
			//echo "<br/>";
			//session_save_path($seshpath);
			//echo session_save_path();
			session_start();  
			$_SESSION["id"] = $row['idUsers'];
			if(isset($_SESSION["id"])){
				echo $_SESSION["id"];
				$_SESSION["pos"] = $row['Position'];
				//The username and password are valid
				//Pass to new page with id as post value
				echo "Logged In!";
				echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/staffpage.php');</script>" ;
			}
		}
	}
}
?>
        
        <form name="LOGIN" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Username<br>
            <input type="text" name="Username"><br><br>
            Password<br>
            <input type="password" name="Password"><br><br>
            <input type="submit" value="Submit" />
        </form>
    </body>
</html>
