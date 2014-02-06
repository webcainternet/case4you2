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

	if (isset($_POST['txtnews'])){

		$txtnews = $_POST['txtnews'];

//		echo "O meu é:".$nome."e meu emai é:".$email."e meu cpf é:".$cpf;

		$sql = "INSERT INTO case4you.c4y_news (email)
				VALUES('$txtnews')";

		$result = $mysqli->query($sql);

		echo $sql;
	}
?>