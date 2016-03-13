<?php

require_once 'config.php';
require_once 'connect.php';

class DB_Functions {
	private $conn;

	function __construct() {
		$db = new DB_Connect();
		$this->conn = $db->connect();
	}
	function __destruct() {
	}

	public function regUser($username, $password, $email) {

		$stmt = $this->conn->prepare("insert into login (username, password, email) values (?, ?, ?)");
		$stmt->bind_param("sss", $username, $password, $email);

		$result = $stmt->execute();
		$stmt->close();

		// Check reurn 
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	
	public function checkUser($username) {
		$stmt = $this->conn->prepare("select username from 
			login where username = ?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($user);
		$stmt->close();

		if ($user) {
			// User exists
			return true;
		} else {
			// User does not exist
			return false;
		}
	}

	public function deleteUser($username) {

		$stmt = $this->conn->prepare("delete from login where 
			username = ?");
		$stmt->bind_param("s", $username);
		$result = $stmt->execute();
		$stmt->close();

		// Check result 
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
}


?>