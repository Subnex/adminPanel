<?php
class AccountDetailsCls {

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

    // Helper function to format date to dd-mm-yyyy
    private function formatDate($date) {
        if ($date) {
            $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $date); // Assuming the date format from DB is Y-m-d H:i:s
            if ($dateObj) {
                return $dateObj->format('d-m-Y'); // Format as dd-mm-yyyy
            }
        }
        return $date; // Return original if it's invalid
    }

    // Helper function to fetch and format query results
    private function fetchAndFormatResults($query, $params = [], $dateColumns = []) {
        $data = $this->executeQuery($query, $params);
        foreach ($data as &$row) {
            foreach ($dateColumns as $column) {
                if (isset($row[$column])) {
                    $row[$column] = $this->formatDate($row[$column]);
                }
            }
        }
        return $data;
    }

    // Main function to get account details
    public function getAccountDetails($acc_id) {
        // Initialize the result array
        $result = [];

        // Fetch user details
        $user_query = "SELECT * FROM users WHERE user_publisher_id = ?";
        $userDetails = $this->executeQuery($user_query, [$acc_id]);
        if ($userDetails) {
            $result['user'] = $userDetails[0]; // Get the first (and likely only) user
            $userCode =  $result['user']['user_code'];

            // Fetch my listing requests
            $listing_query = "
                SELECT id, p.product_code AS productCode, p.product_ref_code AS productRefCode,
                p.product_ref_code AS refCode, p.name AS pName, p.list_price, p.late_fee,
                CASE 
                    WHEN p.product_status = 1 THEN 'Active'
                    WHEN p.product_status = 0 THEN 'Inactive'
                    ELSE 'Unknown'
                END AS product_status
                FROM products p 
                WHERE p.user_publisher_id = ?";
            $result['my_listing'] = $this->fetchAndFormatResults($listing_query, [$acc_id], ['start_date', 'end_date']);

            // Fetch my deals
            $deals_query = "
                SELECT 
                    o.id, o.order_no, rm.title AS rentMode, o.order_code, 
                    o.actual_price AS actulaPrice, o.final_price AS finalPrice,
                    o.order_type, o.product_code, p.name AS productName,
                    o.order_by_user_code AS listerCode, o.order_to_user_code AS opterCode,
                    o.rent_from_date AS startDate, o.rent_to_date AS endDate,
                    l.username AS listerName, op.username AS opterName
                FROM orders o
                JOIN rent_mode rm ON o.rent_mode_code = rm.rent_mode_code
                JOIN users l ON o.order_by_user_code = l.user_code
                JOIN users op ON o.order_to_user_code = op.user_code
                JOIN products p ON o.product_code = p.product_code
                WHERE l.user_publisher_id = ? OR op.user_publisher_id = ?";
            $result['myDeals'] = $this->fetchAndFormatResults($deals_query, [$acc_id, $acc_id], ['startDate', 'endDate']);

            // Fetch requests
            $requests_query = "
                SELECT 
                    r.id AS reqId, r.request_code AS reqCode, op.username AS userName,
                    l.username AS productOwner, p.name AS productName,
                    CASE 
                        WHEN r.opter_request_status = 1 THEN 'Active'
                        WHEN r.opter_request_status = 0 THEN 'Inactive'
                        ELSE 'Unknown'
                    END AS reqStatus, r.created_at AS reqDate
                FROM requests r
                JOIN users op ON r.request_by = op.user_code
                JOIN users l ON r.request_to = l.user_code
                JOIN products p ON r.product_code = p.product_code
                WHERE op.user_publisher_id = ?";
            $result['request'] = $this->fetchAndFormatResults($requests_query, [$acc_id], ['reqDate']);

            // Fetch outgoing requests
            $outgoing_query = "
                SELECT DISTINCT
                    pr.id AS reqId, pr.description, pr.duration, pr.rental_amount AS rental,
                    pr.start_date AS startDate, pr.end_date AS endDate,
                    CASE 
                        WHEN pr.status = 1 THEN 'Active'
                        WHEN pr.status = 0 THEN 'Inactive'
                        ELSE 'Unknown'
                    END AS reqStatus, c.name AS category, sb.name AS subCategory
                FROM product_request pr
                JOIN categories c ON c.category_code = pr.category_code
                JOIN sub_categories sb ON sb.sub_category_code = pr.sub_category_code
                WHERE pr.user_code = ?";
            $result['OutGoingRequest'] = $this->fetchAndFormatResults($outgoing_query, [$userCode], ['startDate', 'endDate']);

        } else {
            $result['error'] = 'Account not found.';
        }

        // Return the result array
        return $result;
    }
}


?>
