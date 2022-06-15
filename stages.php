<?php
require_once ('Models/stageDataSet.php');
require_once ('Models/databaseProjects.php');
require_once ('Models/databaseProjectsSet.php');

$view = new stdClass();
$view->pageTitle = 'Stages';
session_start();
$stageDataSet = new stageDataSet();
$databaseProjectsSet= new databaseProjectsSet();
// print_r($_SESSION);

//list($projectID, $serviceProvider, $wellName,$spudDate, $releaseDate, $KPICategories) = $project;
//echo $projectID, $serviceProvider, $wellName ,$spudDate, $releaseDate, $KPICategories;
//var_dump($_SESSION['jobRole']);
if($_SESSION['jobRole']==""){
    $searchData=$_SESSION['name'];
    $view->stageDataSet=$stageDataSet->fetchStageForEngineer($searchData);
} else {
    $searchData = $_POST['projectID'];
    $_SESSION['wellName']=$_POST['wellName'];
    $_SESSION['spudDate']=$_POST['spudDate'];
    $_SESSION['serviceProvider']=$_POST['serviceProvider'];
    $_SESSION['releaseDate']=$_POST['releaseDate'];
    $_SESSION['kpiCategories']=$_POST['kpiCategories'];
    $_SESSION['projectID']=$_POST['projectID'];
    $view->stageDataSet = $stageDataSet->fetchStagesByWell($searchData);
}
if ($_SESSION['jobRole']=="Manager"){
    $_SESSION['projectID']=$searchData;}
else
    $_SESSION['projectID']=$searchData;


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
    $_SESSION["wellSelect"] = '';
}

if (isset($_POST["wellName"])) {
    $_SESSION['wellSelect']=$_POST['wellName'];
}
if (isset($_POST["graphButton"])) {
    if ($_SESSION['jobRole'] == "Manager") {
        header("Location: graph.php");
    } else {
        echo '<script>alert("Only project leads can view graph dashboard")</script>';
    }
}
//var_dump($view->auctionDataSet);

require_once('Views/stages.phtml');