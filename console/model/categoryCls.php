<?php
class categoryCls{
    
    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php'; 
        $this->ds= new DataSource();
    }
 /**
     *
     * @return string[] category status message
     */
    public function getCategory($search)
    {

        $PDOConnection = $this->ds->getAliveConnection();

        $query = "SELECT * FROM categories where name LIKE '%$search%' order by category_index asc";
        $stmt = $PDOConnection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $categoryList = $stmt->fetchAll();
            //print_r($memberRecord);
        }
        
        return $categoryList;
    }
    /**
     *
     * @return string[] category status message
     */

    public function updateCategory($imgURL)
    {
        $catCode =$_POST["editId"];
        //$catId = $catCode;
        $catName =$_POST["editCatName"];
        $catStatus = 0; 
        if($_POST['newStatus'] ='Active')
        {
            $catStatus = 1;
        }
        $catIndex =$_POST["editIndex"];
        $PDOConnection = $this->ds->getAliveConnection();
        if($imgURL != null)
        {
            $imgName =$_FILES['editfile']['tmp_name'];
            $imgPath =$imgURL;
            $query = "UPDATE categories SET name = :catName, status=:catStatus,category_index = :catIndex ,image_name=:imgName,image_path=:imgPath WHERE category_code = :catCode";
            $stmt = $PDOConnection->prepare($query);
            $stmt->bindParam("catCode",$catCode);
            $stmt->bindParam("catName",$catName);
            $stmt->bindParam("imgName",$imgName);
            $stmt->bindParam("imgPath",$imgPath);
            $stmt->bindParam("catStatus",$catStatus);
            $stmt->bindParam("catIndex",$catIndex);
        }
        else
        {
            $query = "UPDATE categories SET name = :catName, status=:catStatus,category_index = :catIndex  WHERE category_code = :catCode";
            $stmt = $PDOConnection->prepare($query);
            $stmt->bindParam("catCode",$catCode);
            $stmt->bindParam("catName",$catName);
            $stmt->bindParam("catStatus",$catStatus);
            $stmt->bindParam("catIndex",$catIndex);
        }
        //$query = "INSERT into categories(id,category_code,name,image_name,image_path,status,category_index)  VALUES (:catId,:catCode,:catName,:imgName,:imgPath,:newStatus,:catIndex)";
       

        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
       
        $response = array(
            "status" => "Success",
            "message" => "Record Updated."
        );
        return $response;
    }
     /**
     *
     * @return string[] category status message
     */
    public function insertCategory($s3ClientObj,$bucketName,$imgUrl)
    {
        $catCode = random_int(100000, 999999);
        $catId = $catCode;
        $catName =$_POST["newCatName"];
        $newStatus = 0; 
        $createdById='afrdRp4gxGqMy2q6do2mH2rLBljpeABA4dMin';
        $parentid=0;
  
        if($_POST['newStatus'] ='Active')
        {
            $newStatus = 1;
        }
        $catIndex =$_POST["newCatIndex"];
        $PDOConnection = $this->ds->getAliveConnection();
            $imgName =$_FILES['newCatfile']['tmp_name'];
            $imgPath =$imgUrl;

            $query = "INSERT into categories(category_code,name,image_name,image_path,status,category_index,created_by,updated_by,parent_id)  VALUES (:catCode,:catName,:imgName,:imgPath,:newStatus,:catIndex,:createdBy,:updatedBy,:parentId)";
            $stmt = $PDOConnection->prepare($query);
            $stmt->bindParam("parentId",$parentid);
            $stmt->bindParam("catCode",$catCode);
            $stmt->bindParam("catName",$catName);
            $stmt->bindParam("imgName",$imgName);
            $stmt->bindParam("imgPath",$imgPath);
            $stmt->bindParam("newStatus",$newStatus);
            $stmt->bindParam("catIndex",$catIndex);
            $stmt->bindParam("createdBy",$createdById);
            $stmt->bindParam("updatedBy",$createdById);
            
            try{
                $stmt->execute();
            }
            catch(PDOException $e)
            {
                print_r($e->getMessage());
            }
            $response = array(
                "status" => "success",
                "message" => "Category created successfully."
            );
            return $response;
       
    }
}
?>