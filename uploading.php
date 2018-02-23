<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<script type='text/javascript'>alert('I AM THE TEST');</script>";

$targetDir = "uploads/";

//Based off this https://www.sitepoint.com/file-uploads-with-php/ and http://codular.com/php-file-uploads


    echo "<script type='text/javascript'>alert('I am the SENATE');</script>";
    //$uploafFile = $_FILES["file"]
    

    
    
    if ($_FILES["file"]["error"] > 0)
    {
        echo "<script type='text/javascript'>alert('".$_FILES["file"]["name"]."');</script>";
        die('An error ocurred when uploading. 1');
    }
    
    if($_FILES['file']['type'] != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
    {
        die('Unsupported filetype uploaded. 2');
    }
    
    if(file_exists('upload/' . $_FILES['file']['name']))
    {
        die('File with that name already exists. 3');
    }
    
    if(!move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name'])){
    die('Error uploading file - check destination is writeable. 4');
    }
    
    //Fix file name    
    
    //Check if no other file exists
    //Set up permisions

?>
