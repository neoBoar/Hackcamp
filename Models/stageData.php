<?php

class stageData {

    protected $stageID,$casing,$wellName,$kpiCategories,$projectID;
// this constructs an auction data
    public function __construct($dbRow) {
        $this->stageID = $dbRow['StageID'];
        $this->casing = $dbRow['Casing'];
        $this->wellName = $dbRow['WellName'];
        $this->kpiCategories = $dbRow['KPICategories'];
        $this->projectID=$dbRow['ProjectID'];
    }

    /**
     * @return mixed
     */
    public function getStageID()
    {
        return $this->stageID;
    }
    /**
     * @return mixed
     */
    public function getCasing()
    {
        return $this->casing;
    }

    /**
     * @return mixed
     */
    public function getWellName()
    {
        return $this->wellName;
    }

    /**
     * @return mixed
     */
    public function getKpiCategories()
    {
        return $this->kpiCategories;
    }

    /**
     * @return mixed
     */
    public function getProjectID()
    {
        return $this->projectID;
    }
}
