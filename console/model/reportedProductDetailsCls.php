<?php
class reportedProductDetailsCls {

    private $ds;

    public function __construct(){
        // Include the DataSource class to manage database connections
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds = new DataSource();
    }

    // Helper function to execute a query and fetch results
    private function executeQuery($query, $params = []) {
        try {
            // Get an active PDO connection
            $PDOConnection = $this->ds->getAliveConnection();
            // Prepare and execute the query
            $stmt = $PDOConnection->prepare($query);
            $stmt->execute($params);
            // Return the fetched results as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle error (log it, etc.) and return error message
            return ['error' => $e->getMessage()];
        }
    }

    // Method to fetch reported product details
    public function getReportedProductsDetails($recid)
    {
      
        $result = [];
        
        // SQL query to fetch product details
        $query = "SELECT 
            pr.id AS id, 
            pr.product_name AS productName,
            p.product_code AS productCode,
            p.product_ref_code AS productRefCode,  -- Fixed typo here
            p.description AS productDesc,
            p.list_price AS rental,
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
            JOIN products p ON p.id = pr.id
            WHERE 
            pr.id = ?";  // Removed the unnecessary semicolon at the end of the query
       
        // Fetch the product details and store them in the 'product' key of $result
        $result['product'] = $this->executeQuery($query,[$recid]);
      
        // Ensure that there's at least one product in the result before fetching images
        if (!empty($result['product']) && isset($result['product'][0]['productCode'])) {
            $productCode = $result['product'][0]['productCode'];

            // SQL query to fetch images for the product based on its product code
            $imageQuery = "SELECT id, image_path FROM product_images WHERE product_code = ?";
            // Fetch the product images and store them in the 'productImgList' key of $result
            $result['productImgList'] = $this->executeQuery($imageQuery, [$productCode]);
        }

        // Return the result containing product details and image list
        return $result;
    }
    // Method to fetch reported product details
    public function updateReportedProductRec()
    {
        $id = $_POST['editId'];
        $adminComment = $_POST['editResponse'];
        $status = $_POST['editStatus'];

     
        $conn = $this->ds->getAliveConnection();

        $sql = "UPDATE product_report SET admin_team_comment=:adminComment,status=:recStatus WHERE id = :recId";

        $stmt = $conn->prepare($sql);
    
        // Bind parameters
        $stmt->bindParam(':recId', var: $id);
        $stmt->bindParam(':adminComment', $adminComment);  
        $stmt->bindParam(':recStatus', var: $status); 
              
        $response ="";
        // Execute the query
        try{
            $stmt->execute();
            $response = array(
                "status" => "success",
                "message" => "Product details updated successfully."
            );
        }
        catch(PDOException $e)
        {
                //print_r($e->getMessage());
                $response = array(
                    "status" => "fail",
                    "message" => $e->getMessage()
                );
        }
        
        return $response;
    }
    
}
?>
