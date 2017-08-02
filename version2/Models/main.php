<?php 

abstract class Main
{
	public $conn;

	public function __construct()
	{
		try {
			//$this->$conn = '';
			$this->conn = new PDO('mysql:dbname=fruitfarm;host=127.0.0.1', 'root','');

		} catch (PDOException $e) {
			die('connection failure '.$e->getMessage() );
		}
	}
	
}

?>