<?php
require_once ('Models/staffDataSet.php');
// make a view class
$view = new stdClass();
$view->pageTitle = 'Log In';
$view->loggedin = "not logged in";
$staffDataSet = new staffDataSet();
session_start();
$_SESSION['wellSelect'] = "";
if (isset($_POST["graphButton"])) {
    header("Location: graph.php");
}

if (isset($_POST["loginButton"])) {
    // login button was pressed create a session
    $searchData = $_POST['email'];
    $password=$_POST['password'];

    $view->staffDataSet = $staffDataSet->searchStaff($searchData);

    foreach ($view->staffDataSet as $staffData) {
        $pWordCompare=$staffData->getPassword();
        if($pWordCompare==$password){
            $_SESSION["loggedin"] = true;
            $_SESSION["name"]=$staffData->getName();
            $_SESSION["email"]=$staffData->getEmail();
            $_SESSION["jobRole"]=$staffData->getJobRole();
            if($_SESSION["jobRole"]=="Engineer") {
                header("Location: databaseProjects.php");
            } else if ($_SESSION["jobRole"]=="Manager") {
                header("Location: databaseProjects.php");}
            else{
                return;}
        }

        else {
            echo '<script>alert("Incorrect Email/Password")</script>';
            $_SESSION['loggedin'] = false;
        }
    }

}

//var_dump($_SESSION["name"]);
//var_dump($_SESSION["email"]);
//var_dump($_SESSION["jobRole"]);
// actually do something with the page


//if (isset($_SESSION["loggedin"]))
//{
  //  $view->loggedin = "logged in as " . $_SESSION["name"];
  //  $view->role = "Job Role:  " . $_SESSION["jobRole"];
   // if($_SESSION["jobRole"]=="Engineer") {
   // header("Location: stages.php");
//} else if ($_SESSION["jobRole"]=="Manager") {
 //   header("Location: databaseProjects.php");}
//else{
//    return;}
//}
//some conditions


// include the view
require_once('Views/index.phtml');