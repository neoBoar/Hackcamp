<?php

class databaseProjects {

    protected $projectID, $Service_Provider,$Well_name,$Spud_date,$Release_date,$KPI_Categories,$AssignedName,$AssignedEmail ;
// this constructs an auction data
    public function __construct($dbRow) {
        $this->projectID = $dbRow['projectID'];
        $this->Service_Provider = $dbRow['ServiceProvider'];
        $this->Well_name = $dbRow['WellName'];
        $this->Spud_date = $dbRow['SpudDate'];
        $this->Release_date = $dbRow['ReleaseDate'];
        $this->KPI_Categories = $dbRow['KPICategories'];
        $this->AssignedName = $dbRow['AssignedEngineerName'];
        $this->AssignedEmail = $dbRow['AssignedEngineerEmail'];

    }

    public function getProjectID()
    {
        return $this->projectID;
    }

    public function getServiceProvider() {
        return $this->Service_Provider;
    }
// get method for auction lot ID
    public function getWellName() {
        return $this->Well_name;
    }
// get method for auction posting User
    public function getSpudDate() {
        return $this->Spud_date;
    }
    public function getReleaseDate() {
        return $this->Release_date;
    }
    public function getKPI_Categories() {
        return $this->KPI_Categories;
    }

    /**
     * @return mixed
     */
    public function getAssignedName()
    {
        return $this->AssignedName;
    }

    /**
     * @return mixed
     */
    public function getAssignedEmail()
    {
        return $this->AssignedEmail;
    }
}
