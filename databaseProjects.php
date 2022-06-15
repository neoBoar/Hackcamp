<?php

require_once('Models/databaseProjectsSet.php');
require_once ('Models/staffDataSet.php');
$view = new stdClass();
$view->pageTitle='Manager Data';

$databaseProjectsSet=new databaseProjectsSet();

//var_dump($_POST);
session_start();
//['kpiCategory']="";
//var_dump($_SESSION['jobRole']);
if (isset($_POST["logoutButton"])) {
    // logout button was pressed - end the session
    unset($_SESSION["loggedin"]);
    $_SESSION["jobRole"] = "NONE";
    $_SESSION["name"] = "NONE";
    $_SESSION["email"] = "NONE";
    $_SESSION["wellSelect"] = '';
    $view->loggedin = "not logged in";
  header("Location: index.php");

}
//if (isset($_POST['viewButton'])) {
//$_SESSION['kpiCategory']=$_POST['kpiCategory'];}
//if (isset($_POST['searchButton'])) {
 //   $casingSelect = $_POST['casingSelect'];
    // only shows records that match the entered search term
    // echo $searchTerm;
//    $view->managerDataSet = $databaseProjectsSet->fetchSomeCasings($casingSelect);
// this used the fetch some auction function from the model
    // it also take in the search form search word
//}
if ($_SESSION['jobRole']=="Engineer"){
    $view->databaseProjectsSet = $databaseProjectsSet->fetchProjectForEngineer($_SESSION['name']);
}
else {
    $view->databaseProjectsSet = $databaseProjectsSet->fetchAllWells();
    // this is the fetch all button function this gets all of the auction data out of the database through the model
}
if (isset($_POST["backButton"])) {
    header("Location: databaseProjects.php");
    $_SESSION["wellSelect"] = '';
}

$staffDataSet=new staffDataSet();
// Iterating through the product array

$view->staffDataSet = $staffDataSet->fetchAllEngineers();
$staffNameString="";
foreach($view->staffDataSet as $staffData) {
    $staffNameString .= ",";
    $staffNameString .= $staffData->getName();
}
$_SESSION['engineerNames']=$staffNameString;
require_once('Views/databaseProjects.phtml');