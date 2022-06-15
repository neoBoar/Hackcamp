<?php
require_once ('Models/stageDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Create Stage';


session_start();
$wellName=$_SESSION["wellName"];
$kpiCategory=$_SESSION["kpiCategories"];
$jobRole=$_SESSION["jobRole"];
$projectID=$_SESSION['projectID'];
//var_dump($wellName);var_dump($kpiCategory);var_dump($jobRole);

$stageDataSet = new stageDataSet();
if (isset($_POST['createStage'])){
    if ($jobRole=="Manager") {
        $casing = $_POST['casing'];
        $stageDataSet = $stageDataSet->addNewStage($casing,$wellName,$kpiCategory,$projectID);
        header("Location: databaseProjects.php");}
     //   var_dump($wellName);
     //   var_dump($kpiCategory);
      //  var_dump($casing);
    //    var_dump($projectID);
    //}
    else
        echo '<script>alert("Only project leads can create stages")</script>';
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
if (isset($_POST["backButton"])) {
    $_SESSION["wellSelect"] = '';
    header("Location: databaseProjects.php");
}
if (isset($_POST["graphButton"])) {
    if ($_SESSION['jobRole'] == "Manager") {
        header("Location: graph.php");
    } else {
        echo '<script>alert("Only project leads can view graph dashboard")</script>';
    }
}
require_once('Views/createStage.phtml');