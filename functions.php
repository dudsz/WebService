<?php

//require_once 'config.php';
require_once 'connect.php';

class Testing {
	private $conn;

	function __construct() {
		$db = new DB_Connect();
		$this->conn = $db->connect();
	}
	function __destruct() {
	}

	public function loginUser($username, $password) {
		$stmt = $this->conn->prepare("select * from login 
			where username = :un and password= :pw");
		$stmt->bindParam(':un', $username);
		$stmt->bindParam(':pw', $password);
		$stmt->execute();
		$result = $stmt->fetch();

		if ($result) {
			// User exists
			return $result;
		} else {
			// User does not exist
			return false;
		}
	}

	public function regUser($username, $password, $email) {
		$stmt = $this->conn->prepare("insert into login 
			(username, password, email) values (:un, :pw, :email)");
		$stmt->bindParam(':un', $username);
		$stmt->bindParam(':pw', $password);
		$stmt->bindParam(':email', $email);

		$result = $stmt->execute();

		// Check reurn 
		if ($result) {
			$stmt = $this->conn->prepare("select * from login 
				where username = :un");
			$stmt->bindParam(':un', $username);
			$stmt->execute();
			// fetchAll() if multiple rows
			$user = $stmt->fetch();
			return $user;
		} else {
			return false;
		}
	}

	public function checkUser($username) {
		$stmt = $this->conn->prepare("select username from 
			login where username = :un");
		$stmt->bindParam(':un', $username);
		$stmt->execute();
		$result = $stmt->fetch();

		if ($result) {
			// User exists
			return $result;
		} else {
			// User does not exist
			return false;
		}
	}

	public function delUser($username) {
		$stmt = $this->conn->prepare("delete from login where 
		username = :un");
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

	public function alterAI($startID) {
		$stmt = $this->conn->prepare("alter table login 
			auto_increment = :id");
		$stmt->bindParam(':id', $startID);		
		$stmt->execute();
		$stmt->close();
	}
}


?>