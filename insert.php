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
		$jResponse["error"] = FALSE;
		$jResponse["inserted"] = 0;
		$jResponse["msg"] = "User already exists";
		echo json_encode($jResponse);
	} else {
		// Reg user
		$user = $db->regUser($username, $password, $email); 
		if ($user) {
			$jResponse["error"] = FALSE;
			$jResponse["inserted"] = 1;
			$jResponse["msg"] = "Successfully inserted user";
			$jResponse["user"]["username"] = $user["username"];
			$jResponse["user"]["email"] = $user["email"]; 
			echo json_encode($jResponse);
		} else {
			// Failed to register
			$jResponse["error"] = FALSE;
			$jResponse["inserted"] = 0;
			$jResponse["msg"] = "User not inserted"; 
			echo json_encode($jResponse);
		}
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["inserted"] = 0;
	$jResponse["msg"] = "Bad parameters"; 
	echo json_encode($jResponse);
}

?>