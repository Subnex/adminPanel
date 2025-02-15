<?php
class ProductCls{

    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }

    public function getAllProducts($search)
    {
        
        $PDOConnection = $this->ds->getAliveConnection();
        $catMapping =$this->fetchProductCategoryAndSubCategoryMapping($PDOConnection);
        $rentModeMap = $this->getRentalModeMap($PDOConnection);
        $query = "SELECT * FROM products WHERE name LIKE '%$search%'"; 

        $stmt = $PDOConnection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $productList =[];
           // $productList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $product) {

                $productStatus = "InActive";
                if($product["status"] == '1')
                {
                    $productStatus = "Active";
                }
                $categoryArray = $catMapping[$product["category_code"]];
                //echo "<pre>";
                //print_r($categoryArray);
                //echo "</pre>";
                $SubCategoryArray = $categoryArray["subcategories"];
                //echo "<pre>";
               // print_r($SubCategoryArray);
                 echo "</pre>";
                $productList[$product["product_code"]] = [
                    'product_code' => $product["product_code"],
                    'product_ref_code' => $product["product_ref_code"],
                    'name' => $product["name"],
                    'category_name' => $categoryArray["category_name"],
                    'sub_category_name' => $SubCategoryArray[$product["sub_category_code"]]["subcategory_name"],
                    'owner_Name' => $product["user_publisher_id"],
                    'rent_mode_code' => $rentModeMap[$product["rent_mode_code"]]["title"],
                    'list_price' => $product["list_price"],
                    'status' => $productStatus,
                    ];
            }
        }
       
        return $productList;
    }
    private function fetchProductCategoryAndSubCategoryMapping($pdoConn)
    {
        $query = "SELECT category_code,name FROM categories";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }
        $subcategoriesQuery = "SELECT sub_category_code, name, category_code FROM sub_categories";
        $subcategoriesStmt = $pdoConn->prepare($subcategoriesQuery);
        $subcategoriesStmt->execute();
        $subcategories = $subcategoriesStmt->fetchAll(PDO::FETCH_ASSOC);


        $result = [];
        // Initialize the result array with categories using category_id as key
        foreach ($categories as $category) {
            $categoryId = $category['category_code'];
            $result[$categoryId] = [
            'category_id' => $categoryId,
            'category_name' => $category['name'],
            'subcategories' => [] // Initialize an empty array for subcategories
            ];
        }

        foreach ($subcategories as $subcategory) {
            $categoryId = $subcategory['category_code'];
            if (isset($result[$categoryId])) {
                $result[$categoryId]['subcategories'][$subcategory['sub_category_code']] = [
                    'subcategory_code' => $subcategory['sub_category_code'],
                    'subcategory_name' => $subcategory['name']
                ];
            }
        }

       
        return $result;
    }
    // Function to get category name by category ID
    function getRentalModeMap($pdoConn) 
    {
        $query = "SELECT rent_mode_code,title FROM rent_mode";
        $stmt = $pdoConn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
      
            $rentModeList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            // Initialize the result array with categories using category_id as key
            foreach ($rentModeList as $rentMode) 
            {
                $result[$rentMode['rent_mode_code']] = [
                    "code" => $rentMode['rent_mode_code'],
                    "title" =>$rentMode['title']
                ];
            
            }
            return $result;
            
        }
    }

     /**
     *
     * @return string[] admin user update status message
     */
    public function updateproductDetails()
    {
        $conn = $this->ds->getAliveConnection();
       
        $Id = $_POST['editId'];
        $productname = $_POST['editProductname'];
        $status = $_POST['status'];
        //$editCategory = $_POST['editCategory'];
        $editPrice = $_POST['editRentalPrice'];
        $editrentalMode = $_POST['editrentalMode'];
        $status = 0;
        //$productname ='Havells hair dryer';
        if($_POST['editStatus'] =='Active')
        {
            $status = 1;
        }
   
        //$sql = "UPDATE SupportCase SET Name='$name', Status='$status', Message='$msg',Subject='$subject', Email ='$email' WHERE CaseId='$Id'";
        $sql = "UPDATE products SET name=:prodName,list_price=:prodPrice, status = :prodStatus WHERE product_code = :prodCode";

        $stmt = $conn->prepare($sql);
    
        // Bind parameters
        $stmt->bindParam(':prodCode', var: $Id);
        $stmt->bindParam(':prodStatus', $status);  
        $stmt->bindParam(':prodPrice', $editPrice);  
        $stmt->bindParam(':prodName', $productname);  
              
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