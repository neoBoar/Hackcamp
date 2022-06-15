<?php

require_once('Models/managerDataSet.php');

$view = new stdClass();
$view->pageTitle='Manager Data';
session_start();
$managerDataSet=new managerDataSet();
//$chosenCasing = $_SESSION['newCasing'];
if (isset($_POST['stageID'])){
$_SESSION['stageID']=$_POST['stageID'];
}
if(!isset($_SESSION['casing'])){
$_SESSION['casing']=$_POST['casing'];
}
if (isset($_POST["casing"])) {
if ($_SESSION['casing']!=$_POST['casing']){
    $_SESSION['casing']=$_POST['casing'];
}}
//var_dump($_POST);
//var_dump($_SESSION['commentId']);

if (isset($_POST["stageID"])) {
    $searchData = $_POST['stageID'];
    $_SESSION['newCasing']=$searchData;
}
//var_dump($_SESSION['stageID']);
//if (isset($_POST["stageID"])) {
 //   if ($_SESSION['newCasing']!=$_POST['stageID']){
  //      $_SESSION['newCasing']=$_POST['stageID'];
 //   }}
//if (isset($_POST["casing"])) {
 //   $searchData = $_POST['casing'];
 //   $_SESSION['newCasing']=$searchData;
//}


if(isset($_POST['orderSelectButton']))
{
    $casingSelect = "";
    $orderSelect = $_POST['orderSelect'];
    $view->managerDataSet = $managerDataSet->orderKPI($orderSelect);
    $view->managerDataSetS = $managerDataSet->fetchScore($casingSelect);
    $view->itemSearch = 'All Items';
    $view->displayScore = 'Score:';
    $view->displayPercentage = '%';
}
else if (isset($_POST['searchButton'])) {
    $casingSelect = $_POST['searchText'];

    $view->managerDataSet = $managerDataSet->fetchSomeKPI($casingSelect);
    $view->managerDataSetT = $managerDataSet->fetchTarget($casingSelect);
    $view->managerDataSetS = $managerDataSet->fetchScore($casingSelect);
    if ($casingSelect == "") {
        $view->itemSearch = 'All Items';
        $view->displayScore = 'Score:';
        $view->displayPercentage = '%';
    }
    else {
        $view->itemSearch = $_POST['searchText'];
        $view->displayScore = 'Score:';
        $view->displayPercentage = '%';
    }
}
else
{
    $casingSelect = "";
    $view->managerDataSet = $managerDataSet->fetchSomeCasings();
    $view->managerDataSetT = $managerDataSet->fetchTarget($casingSelect);
    $view->managerDataSetS = $managerDataSet->fetchScore($casingSelect);
    $view->itemSearch = 'All Items';
    $view->displayScore = 'Score:';
    $view->displayPercentage = '%';
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
if (isset($_POST['addComment'])){
    header("Location: databaseProjects.php");
}
if (isset($_POST["backButton"])) {
    header("Location: databaseProjects.php");
    $_SESSION["wellSelect"] = '';
}
if (isset($_POST["graphButton"])) {
    if ($_SESSION['jobRole'] == "Manager") {
        header("Location: graph.php");
    } else {
        echo '<script>alert("Only project leads can view graph dashboard")</script>';
    }
}
//$test[]=$managerDataSet->fetchAllIndicatorsForComment();
//var_dump($test);
require_once('Views/managerData.phtml');