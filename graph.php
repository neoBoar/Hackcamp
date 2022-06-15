<?php

require_once('Models/managerDataSet.php');
$managerDataSet=new managerDataSet();
session_start();
$view = new stdClass();
$view->pageTitle = 'Dashboard';

// $_SESSION['wellSelect']="Isabella 30/12d-11";
// print_r($_SESSION);

$_SESSION["barLabels"] = $view->managerDataSet = $managerDataSet->fetchAllCasings();
$_SESSION["barData"] = $view->managerDataSet = $managerDataSet->fetchAllScores();
$_SESSION["30pieLabels"] = $view->managerDataSet = $managerDataSet->fetchKPIItem30();
$_SESSION["30pieData"] = $view->managerDataSet = $managerDataSet->fetchKPIScores30();
$_SESSION["20pieLabels"] = $view->managerDataSet = $managerDataSet->fetchKPIItem20();
$_SESSION["20pieData"] = $view->managerDataSet = $managerDataSet->fetchKPIScores20();
$_SESSION["14pieLabels"] = $view->managerDataSet = $managerDataSet->fetchKPIItem14();
$_SESSION["14pieData"] = $view->managerDataSet = $managerDataSet->fetchKPIScores14();
$_SESSION["9pieLabels"] = $view->managerDataSet = $managerDataSet->fetchKPIItem9();
$_SESSION["9pieData"] = $view->managerDataSet = $managerDataSet->fetchKPIScores9();
$_SESSION["p&apieLabels"] = $view->managerDataSet = $managerDataSet->fetchKPIItempa();
$_SESSION["p&apieData"] = $view->managerDataSet = $managerDataSet->fetchKPIScorespa();

if (isset($_POST["backButton"])) {
    header("Location: databaseProjects.php");
    $_SESSION["wellSelect"] = '';
}

if (isset($_POST["logoutButton"])) {
    // logout button was pressed - end the session
    unset($_SESSION["loggedin"]);
    $_SESSION["jobRole"] = "NONE";
    $_SESSION["name"] = "NONE";
    $_SESSION["email"] = "NONE";
    $view->loggedin = "not logged in";
    header("Location: index.php");
}


require_once('Views/graph.phtml');