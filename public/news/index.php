<?php  

	require "../config.php";

	$host = DB_HOSTNAME;
	$user = DB_USERNAME;
	$pass = DB_PASSWORD;
	$base = DB_DATABASE;

	$mysqli = new mysqli($host, $user, $pass, $base);

	if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
	}
*/
?>