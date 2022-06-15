<?php

class managerData {

    protected $ID, $Casing, $Service_Provider, $Well_Name, $Spud_Date, $Item, $Indicators, $Criteria, $Comments, $Target,$Scale,$Score,$Complete,$Release_Date,$ProjectID,$StageID;
// this constructs an auction data
    public function __construct($dbRow) {
        $this->ID=$dbRow['ID'];
        $this->Casing = $dbRow['Casing'];
        $this->Service_Provider = $dbRow['ServiceProvider'];
        $this->Well_Name = $dbRow['WellName'];
        $this->Spud_Date = $dbRow['SpudDate'];
        $this->Item = $dbRow['Item'];
        $this->Indicators = $dbRow['Indicators'];
        $this->Criteria= $dbRow['Criteria'];
        $this->Comments = $dbRow['Comments'];
        $this->Target = $dbRow['Target'];
        $this->Scale = $dbRow['Scale'];
        $this->Score = $dbRow['Score'];
        $this->Complete = $dbRow['Complete'];
        $this->Release_Date = $dbRow['ReleaseDate'];
        $this->ProjectID=$dbRow['ProjectID'];
        $this->StageID=$dbRow['StageID'];
    }

    public function getID()
    {
        return $this->ID;
    }
// get method for auction ID
    public function getCasing() {
        return $this->Casing;
    }
// get method for auction Start
    public function getServiceProvider() {
        return $this->Service_Provider;
    }
// get method for auction lot ID
    public function getWellName() {
        return $this->Well_Name;
    }
// get method for auction posting User
    public function getSpudDate() {
        return $this->Spud_Date;
    }
// get method for auction description
    public function getItem() {
        return $this->Item;
    }
// get method for auction image
    public function getIndicators() {
        return $this->Indicators;
    }

    public function getCriteria() {
        return $this->Criteria;
    }

    public function getComments() {
        return $this->Comments;
    }
    public function getTarget() {
        return $this->Target;
    }
    public function getScale() {
        return $this->Scale;
    }
    public function getScore() {
        return $this->Score;
    }
    public function getComplete() {
        return $this->Complete;
    }
    public function getReleaseDate() {
        return $this->Release_Date;
    }

    public function getProjectID()
    {
        return $this->ProjectID;
    }

    public function getStageID()
    {
        return $this->StageID;
    }
}