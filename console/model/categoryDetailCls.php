<?php
class categoryDetailCls{
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

        $query = "SELECT * FROM categories where category_code LIKE '%$search%'";
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
    public function getSubCategory($catcode): array
    {

        $PDOConnection = $this->ds->getAliveConnection();

        $query = "SELECT * FROM sub_categories where category_code LIKE '%$catcode%'";
        $stmt = $PDOConnection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $categoryList = $stmt->fetchAll();
            //print_r($memberRecord);
        }
        if($categoryList == null)
            $categoryList=[];

        return $categoryList;
    }
    /**
     *
     * @return string[] category status message
     */
    
     public function insertSubCategory($s3ClientObj,$bucketName,$imgUrl,$catId,$catCode)
     {
         $timestamp = time();
         $subCatCode =   md5($timestamp);//random_int(100000, 999999);
         $subCatId = $subCatCode;
         $catName =$_POST["newCatName"];
         $newStatus = 0; 
         $createdById='afrdRp4gxGqMy2q6do2mH2rLBljpeABA4dMin';

         if($_POST['newStatus'] =='Active')
         {
             $newStatus = 1;
         }
         $catIndex =$_POST["newCatIndex"];
         $PDOConnection = $this->ds->getAliveConnection();
             $imgName =$_FILES['newCatfile']['tmp_name'];
             $imgPath =$imgUrl;
 
             $query = "INSERT into sub_categories(sub_category_code,name,category_id,category_code,image_name,image_path,status,category_index,created_by,updated_by)  VALUES (:subCatCode,:catName,:catId,:catCode,:imgName,:imgPath,:newStatus,:catIndex,:createdBy,:updatedBy)";
             $stmt = $PDOConnection->prepare($query);
            // $stmt->bindParam("subCatId",$subCatId);
             $stmt->bindParam("subCatCode",$subCatCode);
             $stmt->bindParam("catId",$catId);
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
                 $response = array(
                    "status" => "success",
                    "message" => "Sub Category created successfully."
                );
             }
             catch(PDOException $e)
             {
                 print_r($e->getMessage());
                 $response = array(
                    "status" => "fail",
                    "message" => "Sub Category created fail."
                );
             }
            
             return $response;
        
     }

      /**
     *
     * @return string[] category status message
     */

    public function updateSubCategory($imgURL)
    {
        $subCatCode =$_POST["editId"];
        //$catId = $catCode;
        $subCatName =$_POST["editCatName"];
        $catStatus = 0; 
        if($_POST['editStatus'] =='Active')
        {
            $catStatus = 1;
        }
        $catIndex =$_POST["editIndex"];
        $PDOConnection = $this->ds->getAliveConnection();
        if($imgURL != null)
        {
            $imgName =$_FILES['editfile']['tmp_name'];
            $imgPath =$imgURL;
            $query = "UPDATE sub_categories SET name = :subCatName, status=:catStatus,category_index = :catIndex ,image_name=:imgName,image_path=:imgPath WHERE sub_category_code = :subCatCode";
            $stmt = $PDOConnection->prepare($query);
            $stmt->bindParam("subCatCode",$subCatCode);
            $stmt->bindParam("subCatName",$subCatName);
            $stmt->bindParam("imgName",$imgName);
            $stmt->bindParam("imgPath",$imgPath);
            $stmt->bindParam("catStatus",$catStatus);
            $stmt->bindParam("catIndex",$catIndex);
        }
        else
        {
            //echo "data==".$subCatCode ."==".$subCatName."==".$catStatus."==".$catIndex;
            $query = "UPDATE sub_categories SET name = :subCatName, status=:catStatus,category_index = :catIndex  WHERE sub_category_code = :subCatCode";
            //print_r($query);
            $stmt = $PDOConnection->prepare($query);
            $stmt->bindParam("subCatCode",$subCatCode);
            $stmt->bindParam("subCatName",$subCatName);
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
    
}
?>