<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['delete']) && !empty($_POST['delete']) 
	&& isset($_POST['un']) && !empty($_POST['un'])
	&& isset($_POST['wl']) && !empty($_POST['wl'])
	&& isset($_POST['wn']) && !empty($_POST['wn'])) {
	// Set values from post params
	$un = $_POST['un'];
	$wl = $_POST['wl'];
	$wn = $_POST['wn'];

	// Delete wish
	$result = $db->delWish($un, $wl, $wn); 
	if ($result) {
		$jResponse["success"] = 1;
		$jResponse["msg"] = "Wish deleted successfully"; 
		echo json_encode($jResponse);
	} else {
		// Failed to delete
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wish not deleted"; 
		echo json_encode($jResponse);		
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad params"; 
	echo json_encode($jResponse);
}

?>