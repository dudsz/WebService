<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un'])) {
	// Set values from post params
	$username = $_POST['un'];
	// Login user
	$wLists = $db->getLists($username);
	if ($wLists) {		
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 1;
		$jResponse["wishes"] = $wLists;
		echo json_encode($jResponse);
	} else {
		// Failed to register
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "No lists found"; 
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