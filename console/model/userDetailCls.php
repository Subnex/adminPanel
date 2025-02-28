<?php
class userDetailCls
{

    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }

    public function getUserDetails($search)
    {
       // $ds = new DataSource();
        $PDOConnection = $this->ds->getAliveConnection();

        $query = "SELECT * FROM admin WHERE username  LIKE '%$search%'";
        $stmt = $PDOConnection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $memberRecord = $stmt->fetchAll();
            //print_r($memberRecord);
        }
       
        return $memberRecord;
    }
}
?>