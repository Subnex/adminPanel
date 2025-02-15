<?php
class homeCls{

    private $DB; 
    public function __construct(){
        //echo "loading2---";
        require_once __DIR__ . '/../Model/DataSource.php';
        //echo "loading3---";
        $this->DB= new DataSource();
    }

    public function getAllAccount()
    {
       
        $PDOConnection = $this->DB->getAliveConnection();
        $userDetails =[];
        $query = "SELECT COUNT(*) AS record_count FROM users";
        $stmt1 = $PDOConnection->prepare($query);
        try{
            $stmt1->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt1->rowCount() > 0) {
            $accRec1 = $stmt1->fetchAll();
            $userDetails["totalUser"]=['totalUser' =>  $accRec1[0]['record_count']];
        }
        $query = "SELECT COUNT(*) AS record_count FROM users where status =1";
        $stmt2 = $PDOConnection->prepare($query);
        try{
            $stmt2->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt2->rowCount() > 0) {
            $accRec2 = $stmt2->fetchAll();
            $userDetails["totalActiveUser"]=['totalActiveUser' =>  $accRec2[0]['record_count']];
        }
        $query = "SELECT COUNT(*) AS record_count FROM users where status =0";
        $stmt3 = $PDOConnection->prepare($query);
        try{
            $stmt3->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt3->rowCount() > 0) {
            $accRec3 = $stmt3->fetchAll();
            $userDetails["totalInActiveUser"]=['totalInActiveUser' =>  $accRec3[0]['record_count']];
        }
        $query = "SELECT COUNT(*) AS record_count FROM users where DATE(created_at) = CURDATE()";
        $stmt4 = $PDOConnection->prepare($query);
        try{
            $stmt4->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt4->rowCount() > 0) {
            $accRec4 = $stmt4->fetchAll();
            $userDetails["totalRegUserToday"]=['totalRegUserToday' =>  $accRec3[0]['record_count']];
        }
       // print_r($accRec);
        return $userDetails;
    }

    public function FetchProductDetails()
    {
      // echo "feching product details";
        $PDOConnection = $this->DB->getAliveConnection();
        $queryTotalCount = "SELECT COUNT(*) AS record_count FROM products";
        $productDetails =[];
        $stmt1 = $PDOConnection->prepare($queryTotalCount);
        try{
            $stmt1->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt1->rowCount() > 0) {
            $accRec1 = $stmt1->fetchAll();
            $productDetails["totalRec"]=['totalRec' =>  $accRec1[0]['record_count']];
        }
        //print_r($accRec[0]['record_count'])  ;
       // print_r($productDetails)  ;

        $queryTotalActiveCount = "SELECT COUNT(*) AS record_count FROM products where product_status = 0";
        
        $stmt2 = $PDOConnection->prepare($queryTotalActiveCount);
        try{
            $stmt2->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt2->rowCount() > 0) {
            $accRec2 = $stmt2->fetchAll();
            $productDetails["totalActiveRec"]=['totalActiveRec' => $accRec2[0]['record_count']];
        }

        $queryTotalInActiveCount = "SELECT COUNT(*) AS record_count FROM products where product_status = 1";
        
        $stmt3 = $PDOConnection->prepare($queryTotalInActiveCount);
        try{
            $stmt3->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt3->rowCount() > 0) {
            $accRec3 = $stmt3->fetchAll();
            $productDetails["totalInActiveRec"]=['totalInActiveRec' => $accRec3[0]['record_count']];
        }

        $queryTotalActiveCount = "SELECT COUNT(*) AS record_count FROM products where DATE(created_at) = CURDATE()";
        
        $stmt4 = $PDOConnection->prepare($queryTotalActiveCount);
        try{
            $stmt4->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt4->rowCount() > 0) {
            $accRec4 = $stmt4->fetchAll();
            $productDetails["totalCreatedTodayRec"]=['totalCreatedTodayRec' => $accRec4[0]['record_count']];
        }
       // print_r($accRec);
        return $productDetails;
    }
    
    public function FetchCategoryDetails()
    {
      // echo "feching product details";
        $PDOConnection = $this->DB->getAliveConnection();
        $queryTotalCount = "SELECT COUNT(*) AS record_count FROM categories";
        $categoryDetails =[];
        $stmt1 = $PDOConnection->prepare($queryTotalCount);
        try{
            $stmt1->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt1->rowCount() > 0) {
            $accRec1 = $stmt1->fetchAll();
            $categoryDetails["totalRec"]=['totalRec' =>  $accRec1[0]['record_count']];
        }
        //print_r($accRec[0]['record_count'])  ;
       // print_r($productDetails)  ;

        $queryTotalActiveCount = "SELECT COUNT(*) AS record_count FROM categories where status = 1";
        
        $stmt2 = $PDOConnection->prepare($queryTotalActiveCount);
        try{
            $stmt2->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt2->rowCount() > 0) {
            $accRec2 = $stmt2->fetchAll();
            $categoryDetails["totalActiveRec"]=['totalActiveRec' => $accRec2[0]['record_count']];
        }

        $queryTotalInActiveCount = "SELECT COUNT(*) AS record_count FROM categories where status = 0";
        
        $stmt3 = $PDOConnection->prepare($queryTotalInActiveCount);
        try{
            $stmt3->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt3->rowCount() > 0) {
            $accRec3 = $stmt3->fetchAll();
            $categoryDetails["totalInActiveRec"]=['totalInActiveRec' => $accRec3[0]['record_count']];
        }

        $queryTotalActiveCount = "SELECT COUNT(*) AS record_count FROM categories where DATE(created_at) = CURDATE()";
        
        $stmt4 = $PDOConnection->prepare($queryTotalActiveCount);
        try{
            $stmt4->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt4->rowCount() > 0) {
            $accRec4 = $stmt4->fetchAll();
            $categoryDetails["totalCreatedTodayRec"]=['totalCreatedTodayRec' => $accRec4[0]['record_count']];
        }
       // print_r($accRec);
        return $categoryDetails;
    }
    
    public function getAccount($accountId)
    {
        $query='';
        if(!empty($accountId))
        {
            $query = 'SELECT * FROM accounts where AccountID = ?';
            $paramType = 's';
            $paramValue = array(
                $accountId
            );
        }
        $accountRec = $this->DB->select($query, $paramType, $paramValue);
        return $accountRec;
    }


    public function getFlaggedAccount()
    {
        $query='';
        $paramType = 's';
        $paramValue = array(
            'Yes'
        );
        $query = "SELECT * FROM accounts where Flagged =?";
        $conn = $this->DB->getConnection();
        return  $conn->query($query);
    }
    public function activateAccount($accountId)
    {
        $query='';
        if(!empty($accountId))
        {
            $query = 'UPDATE accounts SET status="Active" WHERE AccountID = '.$accountId;
            $accountRec = $this->DB->update($query);
            return $accountRec;
        }
       
       
    }
    public function deActivateAccount($accountId)
    {
        $query='';
        if(!empty($accountId))
        {
            $query = 'UPDATE accounts SET status="InActive" WHERE AccountID = '.$accountId;
            $accountRec = $this->DB->update($query);
            return $accountRec;
        }
       
       
    }

}
?>