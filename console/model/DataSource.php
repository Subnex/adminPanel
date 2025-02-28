<?php

class DataSource
{
    private $conn;

    function __construct()
    {
        $this->conn = $this->getAliveConnection();
    }

    /**
     * Get a persistent PDO connection
     *
     * @return \PDO
     */
    public function getAliveConnection()
    {
        if ($this->conn === null) {
            $this->conn = $this->getPdoConnection();
        }
        return $this->conn;
    }

    /**
     * Establishes and returns a PDO connection.
     *
     * @return \PDO
     */
    private function getPdoConnection()
    {
        require_once __DIR__ . '/config.php';

        try {
            $dsn = "mysql:host=$rdsHost;dbname=$rdsDatabase;port=$rdsPort;charset=utf8mb4";
            $pdo = new PDO($dsn, $rdsUsername, $rdsPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            exit("PDO Connection Error: " . $e->getMessage());
        }

        return $pdo;
    }

    /**
     * Executes a SELECT query and returns the result as an array.
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function select($query, $paramType = "", $paramArray = [])
    {
        $stmt = $this->prepareAndExecute($query, $paramType, $paramArray);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ?: [];
    }

    /**
     * Executes an INSERT query and returns the inserted record's ID.
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert($query, $paramType, $paramArray)
    {
        $stmt = $this->prepareAndExecute($query, $paramType, $paramArray);
        return $this->conn->lastInsertId();
    }

    /**
     * Executes an UPDATE query and returns the last inserted ID.
     *
     * @param string $query
     * @return int
     */
    public function update($query)
    {
        $stmt = $this->prepareAndExecute($query);
        return $this->conn->lastInsertId();
    }

    /**
     * Executes a general query (INSERT, UPDATE, DELETE).
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute($query, $paramType = "", $paramArray = [])
    {
        $this->prepareAndExecute($query, $paramType, $paramArray);
    }

    /**
     * Prepares and executes the given SQL query with parameters.
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return PDOStatement
     */
    private function prepareAndExecute($query, $paramType = "", $paramArray = [])
    {
        $stmt = $this->conn->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        return $stmt;
    }

    /**
     * Binds parameters to the prepared statement.
     *
     * @param PDOStatement $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    private function bindQueryParams($stmt, $paramType, $paramArray = [])
    {
        $params = array_merge([$paramType], $paramArray);
        $refParams = array_map(function (&$param) {
            return $param;
        }, $params);
        call_user_func_array([$stmt, 'bind_param'], $refParams);
    }

    /**
     * Retrieves the number of records that match the query.
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function getRecordCount($query, $paramType = "", $paramArray = [])
    {
        $stmt = $this->prepareAndExecute($query, $paramType, $paramArray);
        $stmt->store_result();
        return $stmt->num_rows;
    }
}
