<?php

$view = new stdClass();
$view->pageTitle = 'Project Lead';

session_start();
if (isset($_POST["logoutButton"])) {
    // logout button was pressed - end the session
    unset($_SESSION["loggedin"]);
    $_SESSION["jobRole"]="NONE";
    $_SESSION["name"]="NONE";
    $_SESSION["email"]="NONE";
    $view->loggedin = "not logged in";
    header("Location: index.php");
}
if (isset($_POST["backButton"])) {
    header("Location: databaseProjects.php");
}

if (isset($_POST["graphButton"])) {
    header("Location: graph.php");
}
    require_once('Views/lead.phtml');