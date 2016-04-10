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

	public function addWish($un, $wl, $wn, $wd, $wpl) {
		$stmt = $this->conn->prepare("insert into wishes 
			(username, wishList, wishName, wishDesc, wishPlace) 
			values (:un, :wl, :wn, :wd, :wpl)");
		$stmt->bindParam(':un', $un);
		$stmt->bindParam(':wl', $wl);
		$stmt->bindParam(':wn', $wn);
		$stmt->bindParam(':wd', $wd);
		$stmt->bindParam(':wpl', $wpl);
		$result = $stmt->execute();

		// Check return 
		if ($result) {
			$stmt = $this->conn->prepare("select * from wishes 
				where username = :un and wishList = :wl
				and wishName = :wn");
			$stmt->bindParam(':un', $un);
			$stmt->bindParam(':wl', $wl);
			$stmt->bindParam(':wn', $wn);
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

	public function getWish($username, $wl, $wn) {
		$stmt = $this->conn->prepare("select wishName, wishDesc, 
			wishPlace from wishes where username = :un 
			and wishList = :wl and wishName = :wn");
		$stmt->bindParam(':un', $username);
		$stmt->bindParam(':wl', $wl);
		$stmt->bindParam(':wn', $wn);
		$stmt->execute();
		$result = $stmt->fetch();

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