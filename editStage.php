<?php
require_once('Models/stageDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Edit Stage';
$stageDataSet = new stageDataSet();
session_start();
if (isset($_POST['stageID'])){
    $_SESSION['editStageID']=$_POST['stageID'];}
if (isset($_POST['editStage'])) {
    if ($_SESSION['jobRole']=="Manager") {
        $stageID = $_SESSION['editStageID'];
        // $_SESSION['editKPIID']=$_POST['kpiID'];
        $stageDataSet2 = new stageDataSet();
        $view->stageDataSet2 = $stageDataSet2->fetchOneStage($stageID);
        foreach ($view->stageDataSet2 as $stageData) {
            $oldCasing = $stageData->getCasing();
        }
        if ($_POST['casing'] == "") {
            $newCasing = $oldCasing;
        } else {
            $newCasing = $_POST['casing'];
        }
        $view->stageDataSet = $stageDataSet->editStage($stageID, $newCasing);
        $view->stageDataSet = $stageDataSet->editKPIbyStageID($stageID, $newCasing);
        header("Location: databaseProjects.php");
    }
    else{
        echo '<script>alert("Only project leads can edit stages")</script>';
    }
}
if (isset($_POST["graphButton"])) {
    if ($_SESSION['jobRole'] == "Manager") {
        header("Location: graph.php");
    } else {
        echo '<script>alert("Only project leads can view graph dashboard")</script>';
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
//if (isset($_POST['editstage'])) {
  //  $_SESSION['editStageID'] = $_POST['stageID'];

  //  $newCasing = $_POST['casing'];

   // var_dump($newCasing);
   // var_dump($ID);
   // if ($newCasing != "") {
   //     $stageDataSet = $stageDataSet->editCasing($ID, $newCasing);
   // }


//}
if (isset($_POST["backButton"])) {
    header("Location: databaseProjects.php");
    $_SESSION["wellSelect"] = '';
}
require_once('Views/editStage.phtml');
