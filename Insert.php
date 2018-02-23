<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>       
        <?php            
            include 'validate.php';
            $FirstName = $LastName = $Position = $Username = $Password = "";
            $FirstNameError = $LastNameError = $PositionError = $UsernameError = $PasswordError =  "";            
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                include 'dblink.php';
                if (empty($_GET["FirstName"]))
                {
                    $FirstNameError = "*";
                }
                else
                {
                    $FirstName = validate($_GET["FirstName"]);
                }   
                 if (empty($_GET["LastName"]))
                {
                    $LastNameError = "*";
                }
                else
                {
                    $LastName = validate($_GET["LastName"]);
                } 
                 if (empty($_GET["Position"]))
                {
                    $PositionError = "*";
                }
                else
                {
                    $Position = validate($_GET["Position"]);
                } 
                 if (empty($_GET["Username"]))
                {
                    $UsernameError = "*";
                }
                else
                {
                    $Username = validate($_GET["Username"]);
                } 
                 if (empty($_GET["Password"]))
                {
                    $PasswordError = "*";
                }
                else
                {
                    $Password = validate($_GET["Password"]);
                } 
                if ($FirstNameError == "" AND $LastNameError == "" AND $PositionError == ""){
                    $database = connect();     
                    $sql = "INSERT INTO users(FirstName,LastName,Position,Username,Pass) VALUES ('$FirstName','$LastName','$Position','$Username','$Password')";
                    $result = mysqli_query($database, $sql);     
                    echo "good";
                }
                else{
                    $errorMsg = "Error";
                    echo "bad";
                }
            }
        ?>
        <form name="Input" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            First Name: <br><input type="text" name="FirstName"> <font color="##FF0000"><?php echo $FirstNameError ?></font> </br>
            Last Name: <br><input type="text" name="LastName"> <font color="##FF0000"><?php echo $LastNameError ?></font> </br>
            Position: <br><input type="text" name="Position"> <font color="##FF0000"><?php echo $PositionError ?></font> </br>
            Username: <br><input type="text" name="Username"> <font color="##FF0000"><?php echo $UsernameError ?></font> </br>
            Password: <br><input type="password" name="Password"> <font color="##FF0000"><?php echo $PasswordError ?></font> </br>
            <input type="submit" name="submit" value="submit" /></br>
        </form>
    </body>
</html>
