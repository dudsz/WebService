<?php

require_once 'functions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['pw']) && !empty($_POST['pw']) 
	&& isset($_POST['email']) && !empty($_POST['email'])) {
	// Set values from post params
	$username = $_POST['un'];
	$password = $_POST['pw'];
	$email = $_POST['email'];

	if ($db->checkUser($username)) {
		// User exists
		echo "User already exists \n";
	} else {
		// Reg user
		$user = $db->regUser($username, $password, $email); 
		if ($user) {
			$jResponse["user"]["username"] = $user["username"];
			$jResponse["user"]["email"] = $user["email"]; 
			echo json_encode($jResponse);
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