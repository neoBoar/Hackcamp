<?php
require_once ('Models/databaseProjectsSet.php');
require_once ('Models/staffDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Create Well';


session_start();
$databaseProjectsSet = new databaseProjectsSet();
$databaseProjectsSet2 = new databaseProjectsSet();
//$staffDataSet= new staffDataSet();
$jobRole=$_SESSION['jobRole'];
if (isset($_POST['createWell'])){
    if ($jobRole=="Manager") {
       $continue="True";
    $serviceProvider=$_POST['serviceProvider'];
    $wellName=$_POST['wellName'];
    $spudDate=$_POST['spudDate'];
    $releaseDate=$_POST['releaseDate'];
    $kpiCategory=$_POST['kpiCategory'];
        if ($_POST['assignedName']=="Select Engineer:"){
            $assignedName="";
        } else{
        $assignedName=$_POST['assignedName'];
        }
    $assignedEmail=$_POST['assignedEmail'];
        $emailMatch=$databaseProjectsSet2=$databaseProjectsSet->returnEmail($assignedName);
        if ($assignedName!=""){
        if ($assignedEmail==""){
            $assignedEmail=$emailMatch;
        }
        else if ($assignedEmail!=$emailMatch){
                $continue="False";
        }
        }
        if ($continue!="False"){

        $databaseProjectsSet = $databaseProjectsSet->addNewWell($serviceProvider,$wellName,$spudDate,$releaseDate,$kpiCategory,$assignedName,$assignedEmail);
        header("Location: databaseProjects.php");
        }
        else{
            echo '<script>alert("Name & Email dont match")</script>';
        }

    }
    else
    {
        echo '<script>alert("Only project leads can create projects")</script>';
    }
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
    header("Location: databaseProjects.php");
}
require_once('Views/createWell.phtml');