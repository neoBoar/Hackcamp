<?php

require_once('Models/database.php');
require_once('Models/managerData.php');

class managerDataSet
{
    protected $_dbHandle, $_dbInstance;
// constructor for the database connection
    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllCasings()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT DISTINCT Casing FROM drills WHERE WellName = '$newWell' GROUP BY Casing";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["Casing"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchAllScores()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT SUM(Score) FROM drills WHERE WellName = '$newWell'  GROUP BY Casing";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["SUM(Score)"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIItem30()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT DISTINCT Item FROM drills WHERE Casing = '30 Inch Casing' AND WellName = '$newWell' GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["Item"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIScores30()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT SUM(Score) FROM drills WHERE Casing = '30 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["SUM(Score)"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIItem20()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT DISTINCT Item FROM drills WHERE Casing = '20 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["Item"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIScores20()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT SUM(Score) FROM drills WHERE Casing = '20 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["SUM(Score)"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIItem14()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT DISTINCT Item FROM drills WHERE Casing = '14 x 13.375 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["Item"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIScores14()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT SUM(Score) FROM drills WHERE Casing = '14 x 13.375 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["SUM(Score)"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIItem9()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT DISTINCT Item FROM drills WHERE Casing = '9.875 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["Item"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIScores9()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT SUM(Score) FROM drills WHERE Casing = '9.875 Inch Casing' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["SUM(Score)"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIItempa()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT DISTINCT Item FROM drills WHERE Casing = 'P & A' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["Item"] . '"';
        }
        return implode("," , $dataSet);
    }

    public function fetchKPIScorespa()
    {
        $newWell = $_SESSION['wellSelect'];
        $sqlQuery = "SELECT SUM(Score) FROM drills WHERE Casing = 'P & A' AND WellName = '$newWell'  GROUP BY Item";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = '"' . $row["SUM(Score)"] . '"';
        }
        return implode("," , $dataSet);
    }

// fetch some auction this is the search bar
    public function fetchSomeCasings()
    {
        $newCasing = $_SESSION['newCasing'];
        $sqlQuery = "SELECT * FROM drills WHERE StageID = '$newCasing'";
        // this fetches all from Auction data
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
//this loops around fetching the related data
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new managerData($row);
        }
        return $dataSet;
    }

    public function fetchSomeKPI($casingSelect) {
        $newCasing = $_SESSION['newCasing'];
        if($casingSelect == "")
        {
            $sqlQuery = "SELECT * FROM drills WHERE StageID = '$newCasing'";
        }
        else
        {
            $sqlQuery = "SELECT * FROM drills WHERE Item= '$casingSelect' AND StageID = '$newCasing'";
        }
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new managerData($row);
        }
        return $dataSet;
    }

    public function orderKPI($orderSelect) {
        $newCasing = $_SESSION['newCasing'];
        if($orderSelect == "Low To High")
        {
            $sqlQuery = "SELECT * FROM drills WHERE StageID = '$newCasing' ORDER BY Score ASC";
            //$sqlQuery = "SELECT * FROM drills WHERE Casing = '$newCasing' ORDER BY Score ASC";
        }
        else if($orderSelect == "High To Low")
        {
            $sqlQuery = "SELECT * FROM drills WHERE StageID = '$newCasing' ORDER BY Score DESC";
           // $sqlQuery = "SELECT * FROM drills WHERE Casing = '$newCasing' ORDER BY Score DESC";
        }
        else if($orderSelect == "")
        {
            $sqlQuery = "SELECT * FROM drills WHERE StageID = '$newCasing'";
           //$sqlQuery = "SELECT * FROM drills WHERE Casing = '$newCasing'";
        }
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new managerData($row);
        }
        return $dataSet;
    }

    public function fetchTarget($itemSelect) {
        $newCasing = $_SESSION['newCasing'];
        if ($itemSelect == "")
        {
            $sqlQuery = "SELECT SUM(Target) AS value_sum FROM drills WHERE StageID = '$newCasing'";
            //$sqlQuery = "SELECT SUM(Target) AS value_sum FROM drills WHERE Casing = '$newCasing'";
        }
        else{
            //$sqlQuery = "SELECT SUM(Target) AS value_sum FROM drills WHERE Item = '$itemSelect' AND Casing = '$newCasing'";
            $sqlQuery = "SELECT SUM(Target) AS value_sum FROM drills WHERE Item = '$itemSelect' AND StageID = '$newCasing'";
        }
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $row = $statement->fetch();
        return $sum = $row['value_sum'];
    }

    public function fetchAllIndicatorsForComment()
{
    $sqlQuery = 'SELECT Indicators FROM drills WHERE Comments="";';
    // this fetches all from Auction data
    $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
    $statement->execute(); // execute the PDO statement
//this loops around fetching the related data
    $indicators = [];
    while ($row = $statement->fetch()) {
        $indicators[] = new managerData($row);
    }
    return $indicators;
}

    // This function produce a sum of the total scores on the KPI data set
    public function fetchScore($itemSelect) {
        $newCasing = $_SESSION['newCasing'];
        if ($itemSelect == "")
        {
            //$sqlQuery = "SELECT ROUND(SUM(Score) / SUM(Target) * 100) AS value_sum FROM drills WHERE Casing = '$newCasing'";
            $sqlQuery = "SELECT ROUND(SUM(Score) / SUM(Target) * 100) AS value_sum FROM drills WHERE StageID = '$newCasing'";
        }
        else
        {
            //$sqlQuery = "SELECT ROUND(SUM(Score) / SUM(Target) * 100) AS value_sum FROM drills WHERE Item = '$itemSelect' AND Casing = '$newCasing'";
            $sqlQuery = "SELECT ROUND(SUM(Score) / SUM(Target) * 100) AS value_sum FROM drills WHERE Item = '$itemSelect' AND StageID = '$newCasing'";
        }
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $row = $statement->fetch();
        return $sum = $row['value_sum'];

    }


public function fetchOneKPI($ID){

        $sqlQuery = "SELECT * FROM drills WHERE ID='" . $ID . "'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new managerData($row);
        }
        return $dataSet;
    }




    public function countAllKPIs(){
        $sqlQuery = "SELECT count(*) FROM drills";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        return $statement->fetchColumn();

    }

    public function addComment($commentText){}

    public function addNewKPI($casing,$serviceProvider,$wellName,$spudDate,$kpiOption,$indicators,$criteria,$releaseDate,$comment,$score,$projectID,$stageID){
        $sqlQuery = 'INSERT INTO drills VALUES (:ID,:Casing,:ServiceProvider,:WellName,:SpudDate,:Item,:Indicators,:Criteria,:Comments,:Target,:Scales,:Score,:Complete,:releaseDate,:projectID,:stageID)';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $comments=$comment;
        $target=5;
        $scale="0-5";
        $score=$score;
        if ($score==""){
            $score=0;
        }
        $complete="";
        $ID=$this->countAllKPIs()+1;
        $statement ->bindParam(':ID',$ID);
        $statement ->bindParam(':Casing',$casing);
        $statement ->bindParam(':ServiceProvider',$serviceProvider);
        $statement ->bindParam(':WellName',$wellName);
        $statement ->bindParam(':SpudDate',$spudDate);
        $statement ->bindParam(':Item',$kpiOption);
        $statement ->bindParam(':Indicators',$indicators);
        $statement ->bindParam(':Criteria',$criteria);
        $statement ->bindParam(':Comments',$comments);
        $statement ->bindParam(':Target',$target);
        $statement ->bindParam(':Scales',$scale);
        $statement ->bindParam(':Score',$score);
        $statement ->bindParam(':Complete',$complete);
        $statement ->bindParam(':releaseDate',$releaseDate);
        $statement ->bindParam(':projectID',$projectID);
        $statement ->bindParam(':stageID',$stageID);
        return $statement->execute();
    }
    public function editItem($ID,$newItem){
    $sqlQuery = 'UPDATE drills SET Item = :newItem WHERE ID = :ID';
    $statement = $this->_dbHandle->prepare($sqlQuery);
    $statement ->bindParam(':newItem',$newItem);
    $statement ->bindParam(':ID',$ID);

    return $statement->execute();

}
    public function editIndicator($ID,$newIndicator){
        $sqlQuery = 'UPDATE drills SET Indicators = :newIndicators WHERE ID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement ->bindParam(':newIndicators',$newIndicator);
        $statement ->bindParam(':ID',$ID);

            return $statement->execute();

    }
    public function editCriteria($ID,$newCriteria){
        $sqlQuery = 'UPDATE drills SET Criteria = :newCriteria WHERE ID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement ->bindParam(':newCriteria',$newCriteria);
        $statement ->bindParam(':ID',$ID);

            return $statement->execute();

    }
    public function editComments($ID,$newComments){
    $sqlQuery = 'UPDATE drills SET Comments = :newComments WHERE ID = :ID';
    $statement = $this->_dbHandle->prepare($sqlQuery);
    $statement ->bindParam(':newComments',$newComments);
    $statement ->bindParam(':ID',$ID);

            return $statement->execute();

}
    public function editScore($ID,$newScore){
        $sqlQuery = 'UPDATE drills SET Score = :newScore WHERE ID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement ->bindParam(':newScore',$newScore);
        $statement ->bindParam(':ID',$ID);

            return $statement->execute();

    }
    public function editKPI($ID,$newItem,$newIndicator,$newCriteria,$newScore,$newComments){
        $sqlQuery= 'UPDATE drills SET Item = :newItem,Indicators = :newIndicators,Criteria = :newCriteria,Comments = :newComments,Score = :newScore WHERE ID = :ID';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement ->bindParam(':newItem',$newItem);
        $statement ->bindParam(':newIndicators',$newIndicator);
        $statement ->bindParam(':newCriteria',$newCriteria);
        $statement ->bindParam(':newComments',$newComments);
        $statement ->bindParam(':newScore',$newScore);
        $statement ->bindParam(':ID',$ID);

        return $statement->execute();
    }

   // public function editKPIByProjectID($ID,$newWellName,$mewServiceProvider,$newSpudDate,$newSeleaseDate)
    //{
    //    $sqlQuery = 'UPDATE drills SET  ServiceProvider = :serviceProvider,WellName = :wellName,SpudDate=:spudDate, ReleaseDate=:releaseDate,  WHERE projectID = :ID';
    //    $statement = $this->_dbHandle->prepare($sqlQuery);
    //    $statement->bindParam(':ID', $ID);
    //    $statement->bindParam(':wellName', $newWellName);
    //    $statement->bindParam(':serviceProvider', $newServiceProvider);
    //    $statement->bindParam(':spudDate', $newSpudDate);
    //    $statement->bindParam(':releaseDate', $newReleaseDate);
    //    return $statement->execute();
    //}


}
