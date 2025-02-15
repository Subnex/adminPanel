<?php
class aboutUsCls
{
    
    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }

    public function getAboutUs($search)
    {
        $PDOConnection = $this->ds->getAliveConnection();
        $query = "SELECT * FROM about_app";
        
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
    public function insertNewVersion()
    {
        $conn = $this->ds->getAliveConnection();
        
        $id = random_int(100000, 999999);
        $about_app_code = $id;
        $title ="version-1";
        $type ='primary';
        $is_deleted = 0;
        $editContent = $_POST['content'];
        $Status = 1; 
    
       // $sql = "UPDATE Banners SET Name='$name', Status='$status', StartDate='$startDate',EndDate='$endDate', ImgUrl ='$$imgUrl' WHERE Id='$Id'";
       // $query = "UPDATE about_app  SET desc = :editContent WHERE id = :editId";
        $query = "Insert into about_app (id,about_app_code,title,type,description,status,is_deleted) VALUES (:id,:code,:title,:type,:desc,:status,:isdeleted)"; 
       
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':code', $about_app_code);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':desc', $editContent);
        $stmt->bindParam(':status', $Status);
        $stmt->bindParam(':isdeleted', $is_deleted);
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
                print_r($e->getMessage());
        }
        $response = array(
            "status" => "success",
            "message" => "Banner created successfully."
        );
       return $response;
    }

     /**
     *
     * @return string[] banner update status message
     */
    public function UpdateAboutUs()
    {
        $conn = $this->ds->getAliveConnection();

        //$id = random_int(100000, 999999);
        $about_app_code = '331240';
        $title ="version-1";
        $type ='primary';
        $is_deleted = 0;
        $desc = $_POST['content'];
        $Status = 1; 
    
       // $sql = "UPDATE Banners SET Name='$name', Status='$status', StartDate='$startDate',EndDate='$endDate', ImgUrl ='$$imgUrl' WHERE Id='$Id'";
        $query = "UPDATE about_app  SET description = :desc WHERE id = :editId";
        //$query = "Insert into about_app (id,about_app_code,title,type,description,status,is_deleted) VALUES (:id,:code,:title,:type,:desc,:status,:isdeleted)"; 
       
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':editId', $about_app_code);
        $stmt->bindParam(':desc', $desc);
       
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
                print_r($e->getMessage());
        }
        
        $response = array(
            "status" => "success",
            "message" => "Banner updated successfully."
        );
       return $response;
    }
}
?>