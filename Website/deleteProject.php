<?php
session_start();
include "dblink.php";
$database = connect();
	$sql = 'DELETE FROM Projects WHERE idProjects = '.$_SESSION['currentProject'].'';
	mysqli_query($database, $sql);
	$_SESSION["currentProject"] = "";
	echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/staffpage.php');</script>" ;
?>