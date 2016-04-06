<?php

require_once 'connect.php';

class Testing {
	private $conn;

	function __construct() {
		$db = new DB_Connect();
		$this->conn = $db->connect();
	}
	function __destruct() {
	}

	public function addWish($un, $wl, $wN, $wD, $wP) {
		$stmt = $this->conn->prepare("insert into wishes 
			(username, wishList, wishName, wishDesc, wishPlace) 
			values (:un, :wl, :wName, :wDesc, :wPlace)");
		$stmt->bindParam(':un', $un);
		$stmt->bindParam(':wl', $wl);
		$stmt->bindParam(':wName', $wN);
		$stmt->bindParam(':wDesc', $wD);
		$stmt->bindParam(':wPlace', $wP);

		$result = $stmt->execute();

		// Check reurn 
		if ($result) {
			$stmt = $this->conn->prepare("select * from wishes 
				where wishName = :wName");
			$stmt->bindParam(':wName', $wN);
			$stmt->execute();
			// fetchAll() if multiple rows
			$wish = $stmt->fetch();
			return $wish;
		} else {
			return false;
		}
	}

	public function getWishList($username, $wl) {
		$stmt = $this->conn->prepare("select * from 
			wishes where username = :un and wishList = :wl");
		$stmt->bindParam(':un', $username);
		$stmt->bindParam(':wl', $wl);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function delWish($wn, $username) {
		$stmt = $this->conn->prepare("delete from wishes where 
		wishName = :wn and username = :un");
		$stmt->bindParam(':wn', $wn);
		$stmt->bindParam(':un', $username);		
		$stmt->execute();		
		$result = $stmt->rowCount();
		//$stmt->close();
		if ($result > 0) {
			return $result;
		} else {
			return false;
		}
	}
}


?>