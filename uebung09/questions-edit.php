<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once("db-lib.php");

    $id = $_GET['id'];

    $db = new Database();
    $$q =  $db->getQuestion($id);

        $question = $q['question'];
        $id = $q['id'];
        $answer0 = $q['answer0'];
        $answer1 = $q['answer1'];
        $answer2 = $q['answer2'];
        $solution = $q['solution'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frage bearbeiten</title>
</head>

<body>

    <form action="questions-update.php" method="post">
        <input type="hidden" id="questionId" name="questionId" value=<?php echo '$id' ?>>
        <h3>Frage:</h3>
        <textarea cols="40" rows="5" name="question" value=<?php echo '$question' ?> required></textarea><br>
        <h3>Antwort 0</h3>
        <input type=radio name="solution" value="0" required>
        <input type=text name="answer0" value=<?php echo '$answer0' ?> required></br>
        <h3>Antwort 1</h3>
        <input type=radio name="solution" value="1" required>
        <input type=text name="answer1" value=<?php echo '$answer1' ?> required></br>
        <h3>Antwort 2</h3>
        <input type=radio name="solution" value="2" required>
        <input type=text name="answer2" value=<?php echo '$answer2' ?> required></br>

        <input type=submit name="store" value="Frage aktualisieren">

    </form>

</body>

</html>
