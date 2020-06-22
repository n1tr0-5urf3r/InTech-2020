<?php require_once(__DIR__ . "/session_lib.php");
startTodoSession();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Meine Todo-Liste</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php
$tasks = getTasks();
$numberOfTasks = sizeof($tasks);

echo <<<END
    <div class="page-header">
        <h1>Todo-Liste <small>($numberOfTasks Aufgaben)</small></h1>
    </div>
END;

if ($numberOfTasks > 0) {
    echo "<ul>";

    foreach ($tasks as $task) {


        echo "<li>$task <form action='tasks-delete.php' method='post' class='inline-form'><button name='task' value='$task'>löschen</button></form> </li>";
    }

    echo "</ul>";
} else {
    echo "Nichts zu tun";
}

?>


<hr>


<form action="tasks-store.php" method="post">

    <label for="task">Todo:</label>
    <input name="task" type="text" id="task">


    <button type="submit">Hinzufügen</button>

</form>

<p style="text-align: center"><a href="reset.php">Liste zurücksetzen</a></p>


</body>
</html>
