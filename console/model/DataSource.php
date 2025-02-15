<?php
class DataSource
{   
    private $conn;

    function __construct()
    {
        $this->conn = $this->getAliveConnection();
    }

   
    /**
     * If you wish to use PDO use this function to get a connection instance
     *
     * @return \PDO
     */
    public function getAliveConnection()
    {
        if($this->conn == null)
        {
            $this->conn = $this->getPdoConnection();
        }

        return $this->conn;
    }
    /**
     * If you wish to use PDO use this function to get a connection instance
     *
     * @return \PDO
     */
    public function getPdoConnection()
    {
        
        require_once __DIR__ . '/config.php';
        $conn = FALSE;
        $host = $rdsHost ;// Replace with your RDS endpoint
        $dbname = $rdsDatabase; // Replace with your database name
        $db_user = $rdsUsername;// Replace with your RDS username
        $db_pass = $rdsPassword; // Replace with your RDS password
        $port = $rdsPort;
       // echo "=inside pdo connection1==".$port;
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
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);
        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        //print_r($stmt);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_all()) {
               // print_r($row);
                $resultset[] = $row;
            }
        }

        if (! empty($resultset)) {
            return $resultset;
        }
    }

    /**
     * To insert
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert($query, $paramType, $paramArray)
    {
       
        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }
    public function Update($query)
    {
       
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

    /**
     * To execute query
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }

    /**
     * 1.
     * Prepares parameter binding
     * 2. Bind prameters to the sql statement
     *
     * @param string $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function getRecordCount($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->conn->prepare($query);
        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }
}
