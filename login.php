<?php

require_once 'functions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['pw']) && !empty($_POST['pw'])) {
	// Set values from post params
	$username = $_POST['un'];
	$password = $_POST['pw'];
	// Login user
	$user = $db->loginUser($username, $password);
	if ($user) {
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 1;
		$jResponse["msg"] = "Login successful";
		$jResponse["user"]["username"] = $user["username"];
		$jResponse["user"]["email"] = $user["email"];
		$jResponse["user"]["password"] = $user["password"];
		echo json_encode($jResponse);
	} else {
		// Failed to register
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "User not inserted"; 
		echo json_encode($jResponse);
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters"; 
	echo json_encode($jResponse);
}

?>