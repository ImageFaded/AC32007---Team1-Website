<?php


class database 
{


    function doConnect()
    {
        $host = "silva.computing.dundee.ac.uk";
        $username = "17agileteam1";
        $password = "0483.at1.3840";
        $database = "17agileteam1db";

        $connection = mysqli_connect($host, $username, $password, $database);
       	if ($connection->connect_error) 
	{
		die("Connection failed: " . $connection->connect_error);
		echo "<script type='text/javascript'>alert('Error,Please refresh page');</script>";
	}
	else
	{
		return $connection;
	}
    }
}

function connect()
{
    $data = new database();
    return $data->doConnect();
}

?>