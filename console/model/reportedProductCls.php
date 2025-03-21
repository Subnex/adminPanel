<?php
class reportedProductCls{

    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }
    // Helper function to execute a query and fetch results
    private function executeQuery($query, $params = []) {
        try {
            $PDOConnection = $this->ds->getAliveConnection();
            $stmt = $PDOConnection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle error (log it, etc.)
            return ['error' => $e->getMessage()];
        }
    }

    public function getAllProducts($search)
    {
        
        $query = "SELECT 
    pr.id AS id, 
    pr.product_name AS productName,
    p.product_code as productCode,
     p.product_ref_code as producRefCode,
    pr.report_date AS reportDate, 
    pr.reason AS reason, 
    pr.status AS status, 
    us.username AS reporterName, 
    ut.username AS productOwnerName
    FROM 
        product_report pr
    JOIN 
        users us ON us.user_code = pr.reporter_name  -- Join users table for reporter
    JOIN 
        users ut ON ut.user_code = pr.product_owner_name  -- Join users table for product owner
    JOIN products p On p.id = pr.id
    WHERE 
        pr.status = 'open';  "; 
        $productList = $this->executeQuery($query);

       
        return $productList;
    }
   

    
}
?>