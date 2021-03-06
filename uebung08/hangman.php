<?php
    session_name("zxmij86u08");
    session_start();
    if (!isset($_SESSION['toGuess'])) {
        header("Location: hangman-init.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Wörter raten</h1>

    <?php
        // Display mask
        echo "<p>";
        foreach ($_SESSION["mask"] as $char){
            echo "{$char} ";
        }
        echo "</p>";
        echo "<form action='hangman-guess.php' method='POST'>";
        $allLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $notUsed = array_diff($allLetters, $_SESSION["guessedLetters"]);
        foreach ($notUsed as $letter){
            echo "<input type='submit' name='letter' value='{$letter}'>";
        }
        echo "</form>";
        echo "<p>Bisherige Fehlversuche {$_SESSION['errorCount']} / 8</p>";

        if ($_SESSION['state'] == 1){
            echo "<h4>Gewonnen! Neues Spiel?</h4>";
            echo "<form action='hangman-init.php'><input type='submit' value='Ja!'> </form>";
        } elseif ($_SESSION['state'] == 2){
            echo "<h4>Verloren! Das Wort wäre {$_SESSION['toGuess']} gewesen. Neues Spiel?</h4>";
            echo "<form action='hangman-init.php'><input type='submit' value='Ja!'> </form>";
        }
        echo "<img src=img/fish-{$_SESSION['errorCount']}.svg></img>";
        ?>

</body>
</html>