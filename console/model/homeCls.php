<?php
class HomeCls
{
    private $DB;

    public function __construct()
    {
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->DB = new DataSource();
    }

    // Helper function to execute a count query
    private function executeCountQuery($query)
    {
        $PDOConnection = $this->DB->getAliveConnection();
        $stmt = $PDOConnection->prepare($query);
        try {
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll();
                return $result[0]['record_count'];
            }
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
        return 0;
    }

    // Function to get all user stats
    public function getAllAccount()
    {
        $userDetails = [
            "totalUser" => ['totalUser' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM users")],
            "totalActiveUser" => ['totalActiveUser' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM users WHERE status = 1")],
            "totalInActiveUser" => ['totalInActiveUser' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM users WHERE status = 0")],
            "totalRegUserToday" => ['totalRegUserToday' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM users WHERE DATE(created_at) = CURDATE()")],
        ];

        return $userDetails;
    }

    // Function to fetch product details
    public function FetchProductDetails()
    {
        $productDetails = [
            "totalRec" => ['totalRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM products")],
            "totalActiveRec" => ['totalActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM products WHERE product_status = 0")],
            "totalInActiveRec" => ['totalInActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM products WHERE product_status = 1")],
            "totalCreatedTodayRec" => ['totalCreatedTodayRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM products WHERE DATE(created_at) = CURDATE()")],
        ];

        return $productDetails;
    }

    // Function to fetch category details
    public function FetchCategoryDetails()
    {
        $categoryDetails = [
            "totalRec" => ['totalRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM categories")],
            "totalActiveRec" => ['totalActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM categories WHERE status = 1")],
            "totalInActiveRec" => ['totalInActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM categories WHERE status = 0")],
            "totalCreatedTodayRec" => ['totalCreatedTodayRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM categories WHERE DATE(created_at) = CURDATE()")],
        ];

        return $categoryDetails;
    }

    // Function to fetch case details
    public function FetchCaseDetails()
    {
        $caseDetails = [
            "totalRec" => ['totalRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM support_cases")],
            "totalActiveRec" => ['totalActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM support_cases WHERE status = 0")],
            "totalInActiveRec" => ['totalInActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM support_cases WHERE status = 1")],
            "totalCreatedTodayRec" => ['totalCreatedTodayRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM support_cases WHERE DATE(create_time) = CURDATE()")],
        ];

        return $caseDetails;
    }

    // Function to fetch outgoing request details
    public function FetchOutGoingRequestDetails()
    {
        $productReqDetails = [
            "totalRec" => ['totalRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM product_request")],
            "totalActiveRec" => ['totalActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM product_request WHERE status = 0")],
            "totalInActiveRec" => ['totalInActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM product_request WHERE status = 1")],
            "totalCreatedTodayRec" => ['totalCreatedTodayRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM product_request WHERE DATE(created_at) = CURDATE()")],
        ];

        return $productReqDetails;
    }

    // Function to fetch deal details
    public function FetchDealDetails()
    {
        $dealDetails = [
            "totalRec" => ['totalRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM book_deal")],
            "totalActiveRec" => ['totalActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM book_deal WHERE opter_deal_status = 0")],
            "totalInActiveRec" => ['totalInActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM orders")],
            "totalCreatedTodayRec" => ['totalCreatedTodayRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM book_deal WHERE DATE(created_at) = CURDATE()")],
        ];

        return $dealDetails;
    }

    // Function to fetch request details
    public function FetchReqDetails()
    {
        $reqDetails = [
            "totalRec" => ['totalRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM requests")],
            "totalActiveRec" => ['totalActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM requests WHERE request_status = 0")],
            "totalInActiveRec" => ['totalInActiveRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM requests WHERE request_status = 1")],
            "totalCreatedTodayRec" => ['totalCreatedTodayRec' => $this->executeCountQuery("SELECT COUNT(*) AS record_count FROM requests WHERE DATE(created_at) = CURDATE()")],
        ];

        return $reqDetails;
    }
}
?>
