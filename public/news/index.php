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

	if (isset($_GET['txtnews'])){

		$txtnews = $_GET['txtnews'];

		echo "OK";

		$sql = "INSERT INTO case4you.c4y_news (email)
				VALUES('$txtnews')";

		$result = $mysqli->query($sql);
	}
?>