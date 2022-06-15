<?php
require_once ('Models/databaseProjectsSet.php');
require_once ('Models/stageDataSet.php');
require_once ('Models/managerDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Edit Project';
$databaseProjectsSet = new databaseProjectsSet();
$stageDataSet = new stageDataSet();
$managerDataSet = new managerDataSet();
session_start();
if (isset($_POST['projectID'])){
    $_SESSION['editProjectID']=$_POST['projectID'];}

if (isset($_POST['editProject'])) {
    if ($_SESSION['jobRole'] == "Manager") {
        $projectID = $_SESSION['editProjectID'];
        $databaseProjectsSet2 = new databaseProjectsSet();
        $continue = "True";
        $view->databaseProjectsSet2 = $databaseProjectsSet2->fetchOneProject($projectID);
        foreach ($view->databaseProjectsSet2 as $databaseProject) {
            $oldProvider = $databaseProject->getServiceProvider();
            $oldWellName = $databaseProject->getWellName();
            $oldSpudDate = $databaseProject->getSpudDate();
            $oldReleaseDate = $databaseProject->getReleaseDate();
            $oldKPICategories = $databaseProject->getKPI_Categories();
            $oldAssignedName = $databaseProject->getAssignedName();
            $oldAssignedEmail = $databaseProject->getAssignedEmail();
        }
        if ($_POST['serviceProvider'] == "") {
            $newServiceProvider = $oldProvider;
        } else {
            $newServiceProvider = $_POST['serviceProvider'];
        }
        if ($_POST['wellName'] == "") {
            $newWellName = $oldWellName;
        } else {
            $newWellName = $_POST['wellName'];
        }
        if ($_POST['spudDate'] == "") {
            $newSpudDate = $oldSpudDate;
        } else {
            $newSpudDate = $_POST['spudDate'];
        }
        if ($_POST['releaseDate'] == "") {
            $newReleaseDate = $oldReleaseDate;
        } else {
            $newReleaseDate = $_POST['releaseDate'];
        }
        if ($_POST['kpiCategory'] == "") {
            $newKPICategories = $oldKPICategories;
        } else {
            $newKPICategories = $_POST['kpiCategory'];
        }
        if ($_POST['assignedName'] == "Select Engineer:") {
            $newAssignedName = $oldAssignedName;
        } else {
            $newAssignedName = $_POST['assignedName'];
        }
        if ($_POST['assignEngineerEmail'] == "") {
            $newAssignedEmail = $oldAssignedEmail;
        } else {
            $newAssignedEmail = $_POST['assignEngineerEmail'];
        }
        $emailMatch = $databaseProjectsSet2 = $databaseProjectsSet->returnEmail($newAssignedName);
        if ($newAssignedName != $oldAssignedName && $newAssignedEmail == $oldAssignedEmail) {
            $newAssignedEmail = $emailMatch;
           // echo '<script>alert("Assigned Email changed to " . $newAssignedEmail)</script>';
        }
        if ($newAssignedName != "") {
            if ($newAssignedEmail != $emailMatch) {
                $continue = "False";
            }
        }
        if ($continue != "False") {
            $view->databaseProjectsSet = $databaseProjectsSet->editProject($projectID, $newServiceProvider, $newWellName, $newSpudDate, $newReleaseDate, $newKPICategories, $newAssignedName, $newAssignedEmail);
            $view->databaseProjectsSet = $databaseProjectsSet->editKPIByProjectID($projectID, $newWellName, $newServiceProvider, $newSpudDate, $newReleaseDate);
            $view->databaseProjectsSet = $databaseProjectsSet->editStageByProjectID($projectID, $newWellName, $newKPICategories);
            header("Location: databaseProjects.php");
        } else {
            echo '<script>alert("Name & Email do not match")</script>';
        }
    } else {
        echo '<script>alert("Only project leads can edit projects")</script>';
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
require_once('Views/editProject.phtml');
