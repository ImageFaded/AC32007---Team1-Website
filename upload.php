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
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="fileToUpload" id="fileToUpload"/>
         <input type="submit" value ="submit file"/>	
         <ul>
            <li>Sent file: <?php echo $_FILES['fileToUpload']['name'];?>
            <li>File size: <?php echo $_FILES['fileToUpload']['size'];?>
            <li>File type: <?php echo $_FILES['fileToUpload']['type'];?>
         </ul>			
      </form>
    </body>
</html>      
<?php
$target_dir = "files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize ($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if($FILES["£fileToUpload"]["size"] > 2000000) {
		echo "File must not be larger than 2MB";
		$uploadOk = 0;
	}
	

?> 


