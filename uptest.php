<?php

//$name = $_FILES['file']['name'];
//$size = $_FILES['file']['size'];
//$size = $_FILES['file']['type'];

//$tmp_name = $_FILES['file']['tmp_name'];

//$error = $_FILES['file']['error'];

/*if (isset($name))
{
	if (!empty($name))
	{
		$location ='D:\uploads';
		echo $location;
		if (move_uploaded_file($tmp_name, $location.$name))
		{
			echo "uploaded";
		}
		else
		{
			echo "Not uploaded";
		}
		
	}
	else
	{
		echo "Please choose a file";
	}
}*/

//ini_set('upload_tmp_dir', 'D:\uploads');

//$temp_file = tempnam(sys_get_temp_dir(), 'Tux');

//echo $temp_file;

$target_dir = 'D:\uploads';
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$file = $_FILES["file"]["tmp_name"];

echo "Error: " . $_FILES["file"]["error"] . "<br>";
echo "Received {$_FILES["file"]["tmp_name"]} - its size is {$_FILES["file"]["size"]} <br>";

echo move_uploaded_file($file, $target_file);

if (move_uploaded_file($file, $target_file) == true) 
	{
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
	} 
	else 
	{
        echo "Sorry, there was an error uploading your file.";
    }

?>




<form action="uptest.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="submit">

</form>