<?php

require_once('Models/database.php');
require_once('Models/stageData.php');

class stageDataSet
{
    protected $_dbHandle, $_dbInstance;
// constructor for the database connection
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllStages()
{
    $sqlQuery = 'SELECT * FROM stages';
    // this fetches all from Auction data
    $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
    $statement->execute(); // execute the PDO statement
//this loops around fetching the related data
    $dataSet = [];
    while ($row = $statement->fetch()) {
        $dataSet[] = new stageData($row);
    }
    return $dataSet;
}

    public function fetchStagesByWell($searchData){
        $sqlQuery = "SELECT * FROM stages WHERE ProjectID ='". $searchData ."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet=[];
        while ($row = $statement->fetch()){
            $dataSet[] = new stageData($row);
        }
        return $dataSet;
    }

    public function fetchStageForEngineer($searchData)
    {
        $sqlQuery = "SELECT * FROM stages WHERE AssignedEngineerName ='". $searchData."'";
        $statement =  $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet=[];
        while ($row = $statement->fetch()){
            $dataSet[] = new stageData($row);
        }
        return $dataSet;
    }

    public function addNewStage($casing,$wellName,$kpiCategories,$projectID){
        $sqlQuery = 'INSERT INTO stages VALUES (:stageID, :casing, :wellName, :kpiCategories,:projectID)';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $ID=$this->countAllStages()+1;
        $statement ->bindParam(':stageID',$ID);
        $statement ->bindParam(':casing',$casing);
        $statement ->bindParam(':wellName',$wellName);
        $statement ->bindParam(':kpiCategories',$kpiCategories);
        $statement ->bindParam(':projectID',$projectID);
        return $statement->execute();
    }

    public function countAllStages(){
        $sqlQuery = "SELECT count(*) FROM stages";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetchColumn();

    }
    public function fetchOneStage($ID){

        $sqlQuery = "SELECT * FROM stages WHERE StageID='" . $ID . "'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new stageData($row);
        }
        return $dataSet;
    }
    public function editStage($ID,$newCasing){
        $sqlQuery= 'UPDATE stages SET Casing = :newCasing WHERE StageID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement ->bindParam(':newCasing',$newCasing);
        $statement ->bindParam(':ID',$ID);
        return $statement->execute();
    }

    public function editKPIbyStageID($ID,$casing)
    {
        $sqlQuery = 'UPDATE drills SET  Casing = :casing  WHERE StageID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->bindParam(':ID', $ID);
        $statement->bindParam(':casing', $casing);
        return $statement->execute();
    }

  //  public function editStageByProjectID($ID,$wellName,$kpiCategories){
  ////      $sqlQuery= 'UPDATE stages SET  WellName = :wellName, KPICategories=:kpiCategories WHERE projectID = :ID';
   //     $statement = $this->_dbHandle->prepare($sqlQuery);
   //     $statement ->bindParam(':ID',$ID);
   //     $statement ->bindParam(':wellName',$wellName);
   //     $statement ->bindParam(':kpiCategories',$kpiCategories);
   //     return $statement->execute();
 //   }
}

