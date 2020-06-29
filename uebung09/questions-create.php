<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frage erstellen</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <form action="questions-store.php" action="post">
        <h3>Frage:</h3>
        <textarea cols="40" rows="5" name="question" required></textarea><br>
        <h3>Antwort 0</h3>
        <input type=radio name="solution" value="0" required>
        <input type=text name="answer0" required></br>
        <h3>Antwort 1</h3>
        <input type=radio name="solution" value="1" required>
        <input type=text name="answer1" required></br>
        <h3>Antwort 2</h3>
        <input type=radio name="solution" value="2" required>
        <input type=text name="answer2" required></br>

        <input type=submit name="store" value="Frage speichern">

    </form>

</body>

</html>