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
            //Include validation file
            include 'validate.php';
            $user = "";
            $userError = "";
            //If a get method is called within the file
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                include 'dblink.php';
                //If there is no input into the textbox
                if (empty($_GET["user"]))
                {
                    $userError = "*";
                }
                else
                {
                    //Validate input
                    $user = validate($_GET["user"]);
                }
                //If there is no error
                if ($userError == ""){
                    //Contect to database and remove user based upon input of ID
                    $database = connect();     
                    $sql = "DELETE FROM users WHERE idUsers = '$user'";
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
            ID: <br><input type="text" name="user"> <font color="##FF0000"><?php echo $userError ?></font> </br>            
            <input type="submit" name="submit" value="submit" /></br>
        </form>
    </body>
</html>
