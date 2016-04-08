<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['wl']) && !empty($_POST['wl']) 
	&& isset($_POST['wn']) && !empty($_POST['wn'])
	&& isset($_POST['wd']) && !empty($_POST['wd'])
	&& isset($_POST['wpl']) && !empty($_POST['wpl'])) {
	// Set values from post params
	$username = $_POST['un'];
	$wishList = $_POST['wl'];
	$wishName = $_POST['wn'];
	$wishDesc = $_POST['wd'];
	$wishPlace = $_POST['wpl'];

	if ($db->getWish($username, $wishList, $wishName)) {
		// Wish already exists
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wish already exists";
		echo json_encode($jResponse);
	} else {
	 	$wish = $db->addWish($username, $wishList, $wishName, 
	 		$wishDesc, $wishPlace);
		if ($wish) {
			$jResponse["error"] = FALSE;
			$jResponse["success"] = 1;
			$jResponse["msg"] = "Wish added";
			echo json_encode($jResponse);
		} else {
			// Failed to register
			$jResponse["error"] = FALSE;
			$jResponse["success"] = 0;
			$jResponse["msg"] = "Wish not added"; 
			echo json_encode($jResponse);
		}
	} 
} else {
	// Bad post params, no values set
	$jResponse["error"] = TRUE;
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters"; 
	echo json_encode($jResponse);
}	 
?>