<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Meine Todo-Liste</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Todo-Liste</h1>


<?php

require_once(__DIR__ . "/inc/Database.php");

$db = new Database();

$tasks = $db->getTasks();

if (sizeof($tasks) > 0) {
    echo "<ul>";

    foreach ($tasks as $task) {

        $name = $task['name'];
        $id = $task['id'];


        echo "<li>$name <form action='tasks-delete.php' method='post' class='inline-form'><button name='id' value='$id'>löschen</button></form> </li>";
    }

    echo "</ul>";
} else {
    echo "Nichts zu tun";
}

?>


<hr>


<form action="tasks-store.php" method="post">

    <label for="task">Todo:</label>
    <input name="name" type="text" id="task">

    <button type="submit">Hinzufügen</button>

</form>

<p><a href="reset.php">Liste zurücksetzen</a></p>


</body>
</html>
