<?php


class Database {

	private $connection;

	public function __construct(){

		$user = get_current_user();
		$myCnf = parse_ini_file("/home/$user/.my.cnf");

		$host = $myCnf['host'];
		$user = $myCnf['user'];
		$password = $myCnf['password'];
		$database = $myCnf['database'];
		$this->connection = new mysqli($host, $user, $password, $database);

	}

	public function __destruct() {
		$this->connection->close();
	}

	function getAllQuestions(){
		$result = $this->connection->query("SELECT * FROM questions");

		$resultArray = [];

		while ($line = $result->fetch_assoc()){
			array_push($resultArray, $line);
		}

		$result->free();
		return $resultArray;

	}

}

?>
