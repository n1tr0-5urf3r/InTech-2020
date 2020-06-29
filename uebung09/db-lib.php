<?php


class Database
{

	private $connection;

	public function __construct()
	{

		$user = get_current_user();
		$myCnf = parse_ini_file("/home/$user/.my.cnf");

		$host = $myCnf['host'];
		$user = $myCnf['user'];
		$password = $myCnf['password'];
		$database = $myCnf['database'];
		$this->connection = new mysqli($host, $user, $password, $database);
	}

	public function __destruct()
	{
		$this->connection->close();
	}

	function getAllQuestions()
	{
		$result = $this->connection->query("SELECT * FROM questions");

		$resultArray = [];

		while ($line = $result->fetch_assoc()) {
			array_push($resultArray, $line);
		}

		$result->free();
		return $resultArray;
	}

	function getQuestion($id){
		$statement = $this->connection->prepare("SELECT * FROM questions WHERE id=?");
		$statement->bind_param("i", $id);
		$statement->execute();
		$statement->bind_result($id, $question, $answer0, $answer1, $answer2, $solution);

		while ($statement->fetch()){
			$result = array("question" => $question,
							"answer0" => $answer0,
							"answer1" => $answer1,
							"answer2" => $answer2,
							"solution" => $solution,
		);
		}
		return $result;
	}

	function insertQuestion($question, $answer0, $answer1, $answer2, $solution)
	{
		$statement = $this->connection->prepare("INSERT INTO questions(question, answer0, answer1, answer2, solution) VALUES (?, ?, ?, ?, ?)");
		$statement->bind_param("ssssi", $question, $answer0, $answer1, $answer2, $solution);
		return $statement->execute();
	}

	function updateQuestion($id, $question, $answer0, $answer1, $answer2, $solution)
	{
		$statement = $this->connection->prepare("UPDATE questions SET question=?, answer0=?, answer1=?, answer2=?, solution=? WHERE id=?");
		$statement->bind_param("ssssii", $question, $answer0, $answer1, $answer2, $solution, $id);
		return $statement->execute();
	}
}
