<?php	
    define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
    define('DB_PASS', '');
	define('DB_NAME', 'paspos');

	// define('DB_HOST', '116.193.190.220');
	// define('DB_USER', 'pp_r_dv');
    // define('DB_PASS', 'I1wD[Wpo9C6RJP@Y');
	// define('DB_NAME', 'pp_r_dev');
	
	//connecting to database and getting the connection object
	$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$koneksi2 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$koneksi3 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$koneksi4 = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
?>