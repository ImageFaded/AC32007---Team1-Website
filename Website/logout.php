<?php
//Code stollen from Dominic jones-tett 2017 edition, but it's alright cause he was a bit of a cunt
session_start();
session_unset();
session_destroy(); 
echo "<script type='text/javascript'>window.location.replace('https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/index.php');</script>" ;
?>