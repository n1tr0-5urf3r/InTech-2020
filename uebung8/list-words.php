<?php
require_once('hangman_lib.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Wörter</title>
</head>
<body>
    <h1>Alle Wörter</h1>
    <table>
      <tr>
            <th>Wort</th>
            <th>Zu raten</th>
            <th>Maske</th>
        </tr>
            <?php
            $allWords = getAllWords();
            foreach ($allWords as $word){
                $guess = transformWord($word);
                $mask = implode(" ", maskWord($word));
                print("<tr>");
                    print("<td>{$word}</td>");
                    print("<td>{$guess}</td>");
                    print("<td>{$mask}</td>");
                print("</tr>");
            }
            unset($word);

            ?>

    </table>
</body>
</html>

