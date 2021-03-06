<?php

require_once 'wishFunctions.php';
$db = new Testing();
$jResponse = array("success" => 0);

if (isset($_POST['un']) && !empty($_POST['un'])) {
	// Set values from post params
	$username = $_POST['un'];
	// User whose list we are getting
	$wLists = $db->getLists($username);
	if ($wLists) {
		$jResponse["success"] = 1;
		$jResponse["msg"] = "Wish lists found";
		$list = array();
		foreach ($wLists as $wList) {
			$il = array();
			$itemList = $db->getWishList($username, $wList["wishListName"]);
			$il["wishListName"] = $wList["wishListName"];
			$il["wishList"] = $itemList;
			$list[] = $il;
		}
		$jResponse["wishLists"] = $list;
		echo json_encode($jResponse);
	} else {
		// Failed to find a list for specifed user
		$jResponse["success"] = 0;
		$jResponse["msg"] = "No lists found";
		echo json_encode($jResponse);
	}
} else {
	// Bad post params, no values set
	$jResponse["success"] = 0;
	$jResponse["msg"] = "Bad parameters";
	echo json_encode($jResponse);
}

?>
