<?php
class indexCls
{
    
    private $ds;
    public function __construct(){
       // $this ->ds =  $this->getPdoConnection();
    }

    /**
     * If you wish to use PDO use this function to get a connection instance
     *
     * @return \PDO
     */
    public function getPdoConnection()
    {
        require_once __DIR__ . '/site_assets/config.php';
 
        $conn = FALSE;
        $host = $rdsHost ;// Replace with your RDS endpoint
        $dbname = $rdsDatabase; // Replace with your database name
        $db_user = $rdsUsername;// Replace with your RDS username
        $db_pass = $rdsPassword; // Replace with your RDS password
        $port = $rdsPort;
        try {

            $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=utf8mb4";
            $pdo = new PDO($dsn, $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            
            exit("PDO Connect Error: " . $e->getMessage());
        }
        return $pdo;
    }

     /**
     * If you wish to use PDO use this function to get a connection instance
     *
     * @return \PDO
     */
    public function getAliveConnection()
    {
        if($this->ds == null)
        {
            $this->ds = $this->getPdoConnection();
        }

        return $this->ds;
    }
    public function getAllFAQ($search)
    {
        $PDOConnection = $this->getAliveConnection();
        $query = "SELECT * FROM faqs WHERE faq_code LIKE '%$search%' OR question LIKE '%$search%'";
        
        $stmt = $PDOConnection->prepare($query);
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt->rowCount() > 0) {
            $bannerRecords = $stmt->fetchAll();
        }
       
        return $bannerRecords;
    }

}
?>