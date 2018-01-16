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
			(wId, username, wishList, wishItemName, wishItemDesc, wishItemAvailableAt) 
			values (:un, :wl, :win, :wid, :wiaa)");
		$stmt->bindParam(':un', $un);
		$stmt->bindParam(':wl', $wl);
		$stmt->bindParam(':win', $win);
		$stmt->bindParam(':wid', $wid);
		$stmt->bindParam(':wiaa', $wiaa);
		$result = $stmt->execute();

		// Check return 
		if ($result) {
			$stmt = $this->conn->prepare("select * from wishes 
				where username = :un and wishList = :wl
				and wishName = :wn");
			$stmt->bindParam(':un', $un);
			$stmt->bindParam(':wl', $wl);
			$stmt->bindParam(':win', $win);
			$stmt->execute();
			// fetchAll() if multiple rows
			$wish = $stmt->fetch();
			return $wish;
		} else {
			return false;
		}
	}

	public function addWishList($un, $wln) {
		$stmt = $this->conn->prepare("insert into wishLists (username, wishListName) values (:un, :wln)");
		$stmt->bindParam(':un', $un);
		$stmt->bindParam(':wln', $wln);
		$result = $stmt->execute();

		// Check return 
		if ($result) {
			$stmt = $this->conn->prepare("select * from wishLists where username = :un and wishListName = :wln");
			$stmt->bindParam(':un', $un);
			$stmt->bindParam(':wln', $wln);
			$stmt->execute();
			$wish = $stmt->fetch();
			return $wish;
		} else {
			return false;
		}
	}

	public function getLists($username) {
		$stmt = $this->conn->prepare("select distinct  wishListName
			from wishes where username = :un");
		$stmt->bindParam(':un', $username);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function getWishList($username, $wl) {
		$stmt = $this->conn->prepare("select wId, wishListName, wishItemName,
			wishItemDesc, wishItemAvailableAt from wishes where username = :un 
			and wishListName = :wl");
		$stmt->bindParam(':un', $username);
		$stmt->bindParam(':wl', $wl);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		echo $result["wishItemName"];
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

	public function checkWishListName($username, $wln) {
		$stmt = $this->conn->prepare("select distinct wishListName from wishLists where username = :un and wishListName = :wln");
		$stmt->bindParam(':un', $username);
		$stmt->bindParam(':wln', $wln);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function delWish($un, $wl, $wn) {
		$stmt = $this->conn->prepare("delete from wishes where 
		username = :un and wishList = :wl and wishName = :wn");
		$stmt->bindParam(':un', $un);
		$stmt->bindParam(':wl', $wl);
		$stmt->bindParam(':wn', $wn);
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
