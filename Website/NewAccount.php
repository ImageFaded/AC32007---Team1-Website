<html>
<head>
<link rel="stylesheet" href="FormStyle.css">
        <meta charset="UTF-8">
<title>New Account</title>
</head>
<body>
<?php
	include "validate.php";
	
	$firstName = $lastName = $position = $postcode = $position = "";
	$firstNameError = $lastNameError = $positionError = $usernameError = $passwordError = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		include "dblink.php";
		if (empty($_POST["Firstname"]))
		{
			$firstNameError = "*";
		}
		else
		{
			$firstName = validate($_POST["Firstname"]);
		}
		if (empty($_POST["Lastname"]))
		{
			$lastNameError = "*";
		}
		else
		{
			$lastName = validate($_POST["Lastname"]);
		}
		if (empty($_POST["Position"]))
		{
			$positionNameError = "*";
		}
		else
		{
			$position = validate($_POST["Position"]);
		}
		if (empty($_POST["Username"]))
		{
			$usernameError = "*";
		}
		else
		{
			$username = validate($_POST["Username"]);
		}
		if (empty($_POST["Password"]))
		{
			$passwordError = "*";
		}
		else
		{
			$password = hash ("md5" , validate($_POST["Password"]));
		}
		
		if ($firstNameError == "" AND $lastNameError == "" AND  $positionError == "" AND  $usernameError == "" AND  $passwordError == "")
		{	
			$database = connect();				
			$sql = "CALL addUserAccount('".$firstName."','".$lastName."','".$position."','".$username."','".$password."')";
			$result = mysqli_query($database, $sql);
			echo "<script type='text/javascript'>alert('".$sql."');</script>";
		}
		else
		{
		$errorMsg = " ERROR PLEASE FILL IN THE MARKED FIELDS";
	}
	}
?>
<form name ="input" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	First Name: <br><input type="text" name="Firstname"> <font color="##FF0000"><?php echo $firstNameError ?></font> </br>
	Surname: <br><input type="text" name="Lastname"> <font color="##FF0000"><?php echo $lastNameError ?></font> </br>
	Position: <br><input type="text" name="Position"> <font color="##FF0000"><?php echo $positionError ?></font> </br>
	Username: <br><input type="text" name="Username"> <font color="##FF0000"><?php echo $usernameError ?></font> </br>
	Password: <br><input type="text" name="Password"> <font color="##FF0000"><?php echo $passwordError ?></font> </br>
	<input type="submit" name="submit" value="submit" /></br>
</form>
</body>
</html>