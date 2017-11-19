<?php
//Edit the following fields in order to establish a connection with MySQL
//********************************************************************************
$dbhost	= "localhost"; //Leave this as 'localhost' once uploaded on a server
$dbuser	= "root"; //Username that is allowed to access the database
$dbpass	= ""; //Password
$dbname	= "social_network"; //Name of the database
//********************************************************************************

$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database");
mysqli_select_db($conn, $dbname);
?>