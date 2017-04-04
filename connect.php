<?php

//Define Connection Parameters
//
$DBServer = 'localhost'; // e.g 'localhost' or '192.168.1.100'
$DBUser   = 'root';
$DBPass   = '';
$DBName   = 'writenow';


//connect using object oriented method
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

// check connection
if ($conn->connect_error) {   //--->mysqli::$connect_errno — Returns the error code from last connect call
	if (__DEBUG==0) {echo "<p>Database connection failed: $conn->connect_error, E_USER_ERROR";}
	exit("<p>PHP script terminated");

}
?>
