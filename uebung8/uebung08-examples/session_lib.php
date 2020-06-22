<?php

// startet die Session und initialisiert das tasks-Array
function startTodoSession()
{
    // Setze einen eindeutigen Session-Name: zdvlogin mit suffix todo
    // get_current_user() liefert den Benutzernamen
    session_name(get_current_user() . "todo");
    session_start();

    if (!isset($_SESSION['tasks'])) {
        resetTasks();
    }
}

// Fügt einen Task zum Array hinzu
function addTask($task)
{
    array_push($_SESSION['tasks'], $task);
}


// Entfernt einen Task aus dem Array hinzu
function removeTask($task)
{
    $_SESSION['tasks'] = array_diff($_SESSION['tasks'], [$task]);
}


// Liefert alle Tasks
function getTasks()
{
    return $_SESSION['tasks'];
}


// Löscht alle Tasks
function resetTasks()
{
    $_SESSION['tasks'] = [];
}
