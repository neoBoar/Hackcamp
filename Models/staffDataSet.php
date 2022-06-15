<?php
require_once('models/database.php');
require_once('models/staffData.php');

class staffDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance=database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllStaff(){
       $sqlQuery = 'SELECT * FROM staff';
       $statement = $this->_dbHandle->prepare($sqlQuery);
       $statement->execute();
       $dataset = [];
       while ($row = $statement->fetch()){
           $dataset[] = new staffData($row);
       }
       return $dataset;
    }

    public function fetchAllEngineers(){
        $sqlQuery = 'SELECT * FROM staff WHERE jobrole="Engineer"';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataset = [];
        while ($row = $statement->fetch()){
            $dataset[] = new staffData($row);
        }
        return $dataset;
    }

    public function returnEmail($engineerName){
        $sqlQuery = "SELECT * FROM staff WHERE name='". $engineerName."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataset=[];
        while ($row = $statement->fetch()){
            $dataset[] = new staffData($row);
        }
        return $dataset;
    }

    public function searchStaff($searchData){
        $sqlQuery = "SELECT * FROM staff WHERE email='". $searchData."'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataset=[];
        while ($row = $statement->fetch()){
            $dataset[] = new staffData($row);
        }
        return $dataset;
    }
    public function checkEngineerName($checkData){
        $sqlQuery = 'SELECT * FROM staff';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataset = [];
        while ($row = $statement->fetch()){
            $dataset[] = new staffData($row);
        }
        foreach ($view->staffDataSet as $staffData){}
        if ($checkData == $staffData->getName()) {
            return true;
        }
        else
            return false;
    }
    public function checkEngineerEmail($checkData){
        $sqlQuery = 'SELECT * FROM staff';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataset = [];
        while ($row = $statement->fetch()){
            $dataset[] = new staffData($row);
        }
        foreach ($view->staffDataSet as $staffData){}
        if ($checkData == $staffData->getEmail()) {
            return true;
        }
        else
            return false;
    }


}