<?php
class ProductDetailCls {

    private $DB; 

    public function __construct() {
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->DB = new DataSource();
    }

    // Helper function to execute a query and fetch results
    private function executeQuery($query, $params = []) {
        try {
            $PDOConnection = $this->DB->getAliveConnection();
            $stmt = $PDOConnection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle error (log it, etc.)
            return ['error' => $e->getMessage()];
        }
    }

    // Main function to get product details
    public function getProductsDetails($product_id) {
        // Initialize the result array
        $result = [];

        // Fetch product details
        $product_query = "SELECT p.id,p.name as pname,p.list_price as listPrice,p.description as pDesc,c.name  as pCategory,sc.name as psubCategory,
        CASE 
                    WHEN p.product_status = 0 THEN 'Active'
                    WHEN p.product_status = 1 THEN 'Inactive'
                    ELSE 'Unknown'
                END AS product_status
        
         FROM products p
         JOIN categories c on c.category_code =p.category_code
         JOIN sub_categories sc on sc.sub_category_code = p.sub_category_code
          WHERE product_code =?";
        $product = $this->executeQuery($product_query, [$product_id]);

        if ($product) {
            $result['product'] = $product[0]; // Get the first (and likely only) product

            // Fetch product images (use fetchAll if there are multiple images)
            $product_image_query = "SELECT * FROM product_images WHERE product_code = ?";
            $productImages = $this->executeQuery($product_image_query, [$product_id]);
            $result['productImg'] = $productImages;
           // print_r($result['productImg'] );
            // Fetch pending requests
            $pending_requests_query = "
                SELECT r.id, u.username, p.name, 
                r.request_status, 
                r.created_at
                FROM requests r
                JOIN users u ON r.request_by = u.user_code
                JOIN products p ON r.product_code = p.product_code
                WHERE r.product_code = ? AND r.request_status = 0
            ";
            $result['pending_requests'] = $this->executeQuery($pending_requests_query, [$product_id]);

            // Fetch approved requests
            $approved_requests_query = "
                SELECT r.id, u.username, p.name, r.request_status, r.created_at
                FROM requests r
                JOIN users u ON r.request_by = u.user_code
                JOIN products p ON r.product_code = p.product_code
                WHERE r.product_code = ? AND r.request_status = 1
            ";
            $result['approved_requests'] = $this->executeQuery($approved_requests_query, [$product_id]);

            // Fetch related deals
            $deals_query = "
                SELECT o.id, o.order_no, o.order_type, o.rent_from_date as startDate, 
                       o.rent_to_date as endDate, o.actual_price as actualPrice, 
                       o.final_price as finalPrice, r.username as OpterName, 
                       l.username as ListerName, rm.title as rentMode, p.name
                FROM orders o
                JOIN users r ON o.order_by_user_code = r.user_code
                JOIN users l ON o.order_to_user_code = l.user_code
                JOIN rent_mode rm ON o.rent_mode_code = rm.rent_mode_code
                JOIN products p ON o.product_code = p.product_code
                WHERE o.product_code = ?
            ";
            $result['deals'] = $this->executeQuery($deals_query, [$product_id]);

             // Fetch Reported Details 
             $deals_query = "SELECT 
                pr.id AS id, 
                pr.product_name AS productName,
                p.product_code as productCode,
                p.product_ref_code as producRefCode,
                DATE_FORMAT(pr.report_date, '%d-%m-%Y') AS reportDate, 
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
                 p.product_code =? ";
         $result['reportedRec'] = $this->executeQuery($deals_query, [$product_id]);

        } else {
            $result['error'] = 'Product not found.';
        }

        // Return the result array
        return $result;
    }
}
?>
