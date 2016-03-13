<?php

class DB_Connect {
	private $conn;

	// Connecting to the database
	public function connect() {
		require_once ('config.php');
		// Connecting to mysql database
		$this->conn = new mysqli(DB_Host, DB_User, DB_Pw, DB_Name);
		
		if ($this->conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		// Return database handler
		return $this->conn;
	}
}
?>