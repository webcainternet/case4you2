<?php  

	require "../config.php";

	$host = DB_HOSTNAME;
	$user = DB_USERNAME;
	$pass = DB_PASSWORD;
	$base = DB_DATABASE;

	echo $host;
	echo $user;
	echo $pass;
	echo $base;
/*


	$mysqli = new mysqli($host, $user, $pass, "pelo_bem");

	if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
	}
*/
?>