<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once("db-lib.php");

    $id = $_GET['id'];

    $db = new Database();
    $q =  $db->getQuestion($id);

    $question = $q['question'];
    $answer0 = $q['answer0'];
    $answer1 = $q['answer1'];
    $answer2 = $q['answer2'];
    $solution = $q['solution'];

    $s0 = '';
    $s1 = '';
    $s2 = '';

    switch ($solution) {
        case 0:
            $s0 = 'checked';
            break;
        case 1:
            $s1 = 'checked';
            break;
        case 2:
            $s2 = 'checked';
            break;
    }
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
        <input type="hidden" id="questionId" name="questionId" value=<?php echo $id ?>>
        <h3>Frage:</h3>
        <textarea cols="40" rows="5" name="question" required><?php echo $question ?></textarea><br>
        <h3>Antwort 0</h3>
        <input type=radio name="solution" value="0" required <?php echo $s0?>>
        <input type=text name="answer0" value="<?php echo $answer0 ?>" required></br>
        <h3>Antwort 1</h3>
        <input type=radio name="solution" value="1" required <?php echo $s1?>>
        <input type=text name="answer1" value="<?php echo $answer1 ?>" required></br>
        <h3>Antwort 2</h3>
        <input type=radio name="solution" value="2" required <?php echo $s2?>>
        <input type=text name="answer2" value="<?php echo $answer2 ?>" required></br>

        <input type=submit name="store" value="Frage aktualisieren">

    </form>

</body>

</html>