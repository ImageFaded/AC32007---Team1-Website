  


include "dblink.php";

$con = connect();

/*$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
if(!empty($_FILES['myimage']['name']) 
     && file_exists($_FILES['myimage']['name'])) {
    $imagetmp= addslashes(file_get_contents($_FILES['myimage']['name']));
}
else
{
	echo "empty";
}*/

//Insert the image name and image content in image_table
$sql="INSERT INTO image_table VALUES('$image','name')";

//mysql_query($insert_image);


/*$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";*/

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "select * from image_table";

$result=mysqli_query($con,$sql);

while ($row=mysqli_fetch_row($result))
{
	//header('Content-type: image/jpg');
     echo $row[0];
}

?>