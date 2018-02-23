
<form action="yetanotheruploadtest.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="submit">

</form>

<?php'
echo $_FILES["file"]["name"]';
$f = fopen('$_FILES["file"]["name"]','r');
while(!feof($f)){
    $chunk = fread($f,CHUNK_SIZE);
    //handle the file
}
fclose($f);
?>