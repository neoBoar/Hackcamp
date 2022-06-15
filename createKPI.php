<?php
require_once ('Models/managerDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Create KPI';


session_start();
$wellName=$_SESSION["wellName"];
//$kpiCategory=$_SESSION["kpiCategory"];
$jobRole=$_SESSION["jobRole"];
//var_dump($_SESSION['kpiCategories']);
//var_dump($wellName);var_dump($kpiCategory);var_dump($jobRole);

$managerDataSet = new managerDataSet();
if (isset($_POST['createKPI'])){
        $casing=$_SESSION['casing'];
        $serviceProvider=$_SESSION['serviceProvider'];
        $wellName=$_SESSION["wellName"];
        $spudDate=$_SESSION['spudDate'];
        $projectID=$_SESSION['projectID'];
        $kpiOption=$_POST['kpiOption'];
        $indicators=$_POST['indicators'];
        $criteria=$_POST['criteria'];
        $releaseDate=$_SESSION["releaseDate"];
        $comment=$_POST['comment'];
        $score=$_POST['score'];
        $stageID=$_SESSION['stageID'];
        var_dump($casing);
        var_dump($serviceProvider);
        var_dump($wellName);
        var_dump($spudDate);
        var_dump($projectID);
        var_dump($kpiOption);
        var_dump($indicators);
        var_dump($criteria);
        var_dump($releaseDate);
        var_dump($comment);
        var_dump($score);
        var_dump($stageID);
        $managerDataSet = $managerDataSet->addNewKPI($casing,$serviceProvider,$wellName,$spudDate,$kpiOption,$indicators,$criteria,$releaseDate,$comment,$score,$projectID,$stageID);
        header("Location: databaseProjects.php");
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
    if ($_SESSION['jobRole']=="Manager") {
        header("Location: graph.php");
    }
    else    {
        echo '<script>alert("Only project leads can view graph dashboard")</script>';
}
}
require_once('Views/createKPI.phtml');