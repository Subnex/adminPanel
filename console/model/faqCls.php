<?php
class faqCls
{
    
    private $ds;
    public function __construct($fromSite){
        
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }

    public function getAllFAQ($search)
    {
        $PDOConnection = $this->ds->getAliveConnection();
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

     /**
     *
     * @return string[] admin user update status message
     */
    public function insertFAQ()
    {
        $conn = $this->ds->getAliveConnection();
        $id = random_int(100000, 999999);
        $newQues = $_POST['newQues'];
        $newCode = $id;
        $newAns =  htmlspecialchars_decode($_POST['faqAnswer']);
        $newStatus = 0; 
        if($_POST['newStatus'] ='Active')
        {
            $newStatus = 1;
        }

        $query = "Insert into faqs (id,faq_code,question,answer,status) VALUES (:id,:faqCode,:ques,:ans,:status)"; 
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':faqCode', $newCode);
        $stmt->bindParam(':ques', $newQues);
        $stmt->bindParam(':ans', $newAns);
        $stmt->bindParam(':status', $newStatus);
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
                print_r($e->getMessage());
        }
        $response = array(
            "status" => "success",
            "message" => "FAQ created successfully."
        );
       return $response;
    }

     /**
     *
     * @return string[] banner update status message
     */
    public function UpdateFAQ()
    {
        $conn = $this->ds->getAliveConnection();
        $id = $_POST['editId'];
        $editQues = $_POST['newQues'];
        //$editCode = $_POST['editFaqCode'];
        $editAns = $_POST['faqAnswer'];
        $editStatus = 0; 
        if($_POST['newStatus'] ='Active')
        {
            $editStatus = 1;
        }

       // $sql = "UPDATE Banners SET Name='$name', Status='$status', StartDate='$startDate',EndDate='$endDate', ImgUrl ='$$imgUrl' WHERE Id='$Id'";
        $query = "UPDATE faqs  SET question = :ques, answer=:ans,status=:editStatus WHERE id = :editId";
        
       
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':editId', $id);
       // $stmt->bindParam(':faqCode', $editCode);
        $stmt->bindParam(':ques', $editQues);
        $stmt->bindParam(':ans', $editAns);
        $stmt->bindParam(':editStatus', $editStatus);
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
                print_r($e->getMessage());
        }
        
        $response = array(
            "status" => "success",
            "message" => "FAQs updated successfully."
        );
       return $response;
    }
}
?>