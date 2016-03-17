<?php

require_once 'functions.php';
$db = new Testing();

// Create json response array
$jResponse = array("error" => FALSE);

// Get post params
if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['pw']) && !empty($_POST['pw']) 
	&& isset($_POST['email']) && !empty($_POST['email'])) {
	// Set values from post params
	$username = $_POST['un'];
	$password = $_POST['pw'];
	$email = $_POST['email'];

	// Check if username exists
	if ($db->checkUser($username)) {
			// User exists
			echo "User already exists \n";
	} else {
		// Reg user
		if ($db->regUser($username, $password, $email)) {
			// User stored successfully
			// JSON encode response later
			$jResponse["error"] = FALSE;
			$jResponse["uID"] = $user["uID"];
			$jResponse["user"]["username"] = $user["username"]; //"markus";
			$jResponse["user"]["email"] = =$user["email"]; //"m@g";  
			echo json_encode($jResponse);
			//echo "User registered \n";
		} else {
			// Failed to register
			echo "Error occurred while registering \n";
		}
	}
} else {
	// Bad post params, no values set
	echo "Bad params \n";
}

?>