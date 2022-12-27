<?php 
	
	$serverName = "localhost";
	$userName = "root";
	$password = " ";
	$databaseName = "librarymanagementsystem";

	mysql_connect($serverName, $userName, $password) or die(mysql_error());
	mysql_select_db($databaseName) or die(mysql_error());

?>