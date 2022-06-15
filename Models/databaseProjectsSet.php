<?php

require_once('Models/dataBase.php');
require_once('Models/databaseProjects.php');

class databaseProjectsSet
{
    protected $_dbHandle, $_dbInstance;
// constructor for the database connection
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }
// fetch some auction this is the search bar
    public function fetchSomeCasings($casingSelect) {
        if($casingSelect == "0") {
            $sqlQuery = "SELECT * FROM wells";
        }
        else
        {
            $sqlQuery = "SELECT * FROM welllls WHERE Casing = '$casingSelect'";
        }

        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new managerData($row);
        }
        return $dataSet;
    }
// this is the fetch all auction function this gets all of the auctions from the database
    public function fetchAllWells()
    {
        $sqlQuery = 'SELECT * FROM wells';
        // this fetches all from Auction data
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
//this loops around fetching the related data
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new databaseProjects($row);
        }
        return $dataSet;
    }
// this fetchs one auction this is used when hitting the view button this makes it go to one item in one page
    public function fetchOneAuction($AuctionID)
    {
        $sqlQuery ='SELECT * From Auction_Data WHERE AuctionID = ?';
// this selects all from auction where the Id is $auctionID
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO

        $AuctionID= "$AuctionID";
        $statement->bindParam(1,$AuctionID);


        $statement->execute(); // execute the PDO statement
//this loops around fetching the related data
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new managerData($row);
        }
        return $dataSet;
    }
    public function fetchOneWell($searchData)
    {
        $sqlQuery ="SELECT * From wells WHERE projectID = '". $searchData ."'";
// this selects all from auction where the Id is $auctionID
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO
        $statement->execute(); // execute the PDO statement
//this loops around fetching the related data
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new databaseProjects($row);
        }
        return $dataSet;
    }
    public function countAllProjects(){
        $sqlQuery = "SELECT count(*) FROM wells";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetchColumn();

    }
    public function addNewWell($serviceProvider, $wellName, $spudDate, $releaseDate, $kpiCategories,$assignedName,$assignedEmail){
        $sqlQuery = 'INSERT INTO wells VALUES (:projectID, :serviceProvider, :wellName, :spudDate,  :releaseDate, :kpiCategories,:assignedName,:assignedEmail)';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $projectID=$this->countAllProjects()+1;
        $statement ->bindParam(':projectID',$projectID);
        $statement ->bindParam(':serviceProvider',$serviceProvider);
        $statement ->bindParam(':wellName',$wellName);
        $statement ->bindParam(':spudDate',$spudDate);
        $statement ->bindParam(':releaseDate',$releaseDate);
        $statement ->bindParam(':kpiCategories',$kpiCategories);
        $statement ->bindParam(':assignedName',$assignedName);
        $statement ->bindParam(':assignedEmail',$assignedEmail);
        return $statement->execute();
    }
    public function fetchOneProject($ID){

        $sqlQuery = "SELECT * FROM wells WHERE projectID='" . $ID . "'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new databaseProjects($row);
        }
        return $dataSet;
    }
    public function editProject($ID,$newProvider,$newWellName,$newSpudDate,$newReleaseDate,$newKPICategories,$newEngineerName,$newEngineerEmail){
        $sqlQuery= 'UPDATE wells SET ServiceProvider = :newServiceProvider,WellName = :newWellName,SpudDate = :newSpudDate,ReleaseDate = :newReleaseDate,KPICategories = :newKPICategories, AssignedEngineerName = :newAssignedEngineerName, AssignedEngineerEmail = :newAssignedEngineerEmail WHERE projectID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement ->bindParam(':newServiceProvider',$newProvider);
        $statement ->bindParam(':newWellName',$newWellName);
        $statement ->bindParam(':newSpudDate',$newSpudDate);
        $statement ->bindParam(':newReleaseDate',$newReleaseDate);
        $statement ->bindParam(':newKPICategories',$newKPICategories);
        $statement ->bindParam(':newAssignedEngineerName',$newEngineerName);
        $statement ->bindParam(':newAssignedEngineerEmail',$newEngineerEmail);
        $statement ->bindParam(':ID',$ID);
        $statement->execute();
    }
    public function editStageByProjectID($ID,$wellName,$kpiCategories){
        $sqlQuery= 'UPDATE stages SET  WellName = :wellName, KPICategories=:kpiCategories WHERE projectID = :ID';
         $statement = $this->_dbHandle->prepare($sqlQuery);
         $statement ->bindParam(':ID',$ID);
         $statement ->bindParam(':wellName',$wellName);
         $statement ->bindParam(':kpiCategories',$kpiCategories);
         $statement->execute();
}
    public function editKPIByProjectID($ID,$newWellName,$newServiceProvider,$newSpudDate,$newReleaseDate)
    {
        $sqlQuery = 'UPDATE drills SET  ServiceProvider = :serviceProvider,WellName = :wellName,SpudDate=:spudDate, ReleaseDate=:releaseDate WHERE ProjectID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(':ID', $ID);
        $statement->bindParam(':wellName', $newWellName);
        $statement->bindParam(':serviceProvider', $newServiceProvider);
        $statement->bindParam(':spudDate', $newSpudDate);
        $statement->bindParam(':releaseDate', $newReleaseDate);
        $statement->execute();
    }

    public function fetchProjectForEngineer($searchData)
    {
        $sqlQuery = "SELECT * FROM wells WHERE AssignedEngineerName ='". $searchData."'";
        $statement =  $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet=[];
        while ($row = $statement->fetch()){
            $dataSet[] = new databaseProjects($row);
        }
        return $dataSet;
    }
    public function returnEmail($engineerName){
        $sqlQuery = "SELECT * FROM staff WHERE name='". $engineerName."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetchColumn(2);

    }

    public function returnName($engineerEmail){
        $sqlQuery = "SELECT * FROM staff WHERE name='". $engineerEmail."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetchColumn(1);
    }
}

