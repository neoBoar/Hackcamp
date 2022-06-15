<?php
require_once ('Models/managerDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Edit KPI';
$managerDataSet= new managerDataSet();
session_start();

   if (isset($_POST['kpiID'])){
       $_SESSION['editID']=$_POST['kpiID'];}
//$_SESSION['editKPIID'];

//var_dump($_POST['oldItem']);
//var_dump($_POST['oldIndicator']);
//var_dump($_POST['oldCriteria']);
//var_dump($_POST['oldComments']);
//var_dump($_POST['oldScore']);
//var_dump($managerDataSet2);
//$_SESSION['oldItem']=$_POST['oldItem'];
//echo $ID;
if (isset($_POST['editKPI'])){
$kpiID=$_SESSION['editID'];
   // $_SESSION['editKPIID']=$_POST['kpiID'];
    $managerDataSet2=new managerDataSet();
    $view->managerDataSet2=$managerDataSet2->fetchOneKPI($kpiID);
    foreach ($view->managerDataSet2 as $managerData){
        $oldItem=$managerData->getItem();
        $oldIndicator=$managerData->getIndicators();
        $oldCriteria=$managerData->getCriteria();
        $oldComment=$managerData->getComments();
        $oldScore=$managerData->getScore();
        $projectID=$managerData->getProjectID();
    }


if ($_POST['newItem']=="Select Category:"){
    $newItem=$oldItem;
}
else {$newItem=$_POST['newItem'];
}
if ($_POST['indicator']==""){
        $newIndicator=$oldIndicator;
    }
    else {$newIndicator=$_POST['indicator'];
    }
    if ($_POST['criteria']==""){
        $newCriteria=$oldCriteria;
    }
    else {$newCriteria=$_POST['criteria'];
    }
    if ($_POST['comment']==""){
        $newComment=$oldComment;
    }
    else {$newComment=$_POST['comment'];
    }
    if ($_POST['score']==""){
        $newScore=$oldScore;
    }
    else {$newScore=$_POST['score'];
    }
    $view->managerDataSet=$managerDataSet->editKPI($kpiID,$newItem,$newIndicator,$newCriteria,$newScore,$newComment);
    var_dump($kpiID);
    var_dump($newItem);
    var_dump($newIndicator);
    var_dump($newCriteria);
    var_dump($newComment);
    var_dump($newScore);
    var_dump($projectID);
    header("Location: databaseProjects.php");
 //var_dump($newItem);var_dump($ID);
// if (!empty($newItem)){
// $managerDataSet=$managerDataSet->editItem($ID,$newItem);}
// else{
//     echo $newItem;}

//var_dump($newIndicator);
//if (!empty($newIndicator)){
//    $managerDataSet=$managerDataSet->editIndicator($ID,$newIndicator);
//}
//else{
  //  echo $newIndicator;}

//var_dump($newCriteria);
//if (!empty($newCriteria)){
 //   $managerDataSet=$managerDataSet->editCriteria($ID,$newCriteria);
//}
//else{
//    echo $newCriteria;}

   // var_dump($newComments);
 //   if (!empty($newComments)){
 //       $managerDataSet=$managerDataSet->editComments($ID,$newComments);
 //   }
 //   else{
 //       echo $newComments;}

    //var_dump($newScore);
 //   if (!empty($newScore)){

  //      $managerDataSet=$managerDataSet->editScore($ID,$newScore);
 //   }
 //   else{
 //       echo $newScore;}
   // $managerDataSet=$managerDataSet->editItem($ID,$newItem);
   // $managerDataSet=$managerDataSet->editIndicator($ID,$newIndicator);
   // $managerDataSet=$managerDataSet->editCriteria($ID,$newCriteria);
  //  $managerDataSet=$managerDataSet->editComments($ID,$newComments);
  //  $managerDataSet=$managerDataSet->editScore($ID,$newScore);

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
require_once('Views/editKPI.phtml');
