<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8">
	<title>Quizfragen</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<h1>Fragen</h1>
	<table>
		<tr>
			<th>Frage</th>
			<th>Antwort0</th>
			<th>Antwort1</th>
			<th>Antwort2</th>
			<th></th>
			<th></th>
		</tr>
		<?php
		require_once("db-lib.php");

		$db = new Database();

		$questions = $db->getAllQuestions();

		if (sizeof($questions) > 0) {

			foreach ($questions as $q) {

				$s0 = '';
				$s1 = '';
				$s2 = '';

				$frage = $q['question'];
				$id = $q['id'];
				$answer0 = $q['answer0'];
				$answer1 = $q['answer1'];
				$answer2 = $q['answer2'];
				$solution = $q['solution'];

				// This is ugly af but works
				switch ($solution) {
					case 0:
						$s0 = 'solution';
						$s1 = 'answer';
						$s2 = 'answer';
						break;
					case 1:
						$s1 = 'solution';
						$s0 = 'answer';
						$s2 = 'answer';

						break;

					case 2:
						$s1 = 'answer';
						$s0 = 'answer';
						$s2 = 'solution';
						break;
				}

				echo "<tr><td id=>$frage</td><td class=$s0>$answer0</td><td class=$s1>$answer1</td><td class=$s2>$answer2</td><td>
				<form action='questions-edit.php' method='get'>
					<input type='hidden' value=$id>
					<input type='submit' value='Bearbeiten'></form>
				</td><td>
				<form action='questions-delete.php' method='post'>
				<input type='hidden' value=$id>
				<input type='submit' value='Löschen'></form></td></tr>";
			}
		} else {
			echo "Keine Fragen vorhanden.";
		}


		?>


	</table>
	<a href="questions-create.php">Frage hinzufügen</a>
</body>

</html>