<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("error" => FALSE);

if (isset($_POST['un']) && !empty($_POST['un']) 
	&& isset($_POST['wl']) && !empty($_POST['wl'])) {
	// Set values from post params
	$username = $_POST['un'];
	$wishlist = $_POST['wl'];
	// Login user
	$wl = $db->getWishList($username, $wishlist);
	if ($wl) {		
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 1;
		$jResponse["username"] = $username;
<<<<<<< HEAD
		$jResponse["wishlist"] = $wishlist;
=======
		$jResponse["wishList"] = $wishList;
>>>>>>> cb008efb9180b5c98727d67359edcc3252d6cf96
		$jResponse["wishes"] = $wl;
		echo json_encode($jResponse);
	} else {
		// Failed to register
		$jResponse["error"] = FALSE;
		$jResponse["success"] = 0;
		$jResponse["msg"] = "Wishlist not found"; 
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
