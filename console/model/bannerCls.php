<?php
class BannerCls
{
    
    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }

    public function getAllBanner($search)
    {
        $PDOConnection = $this->ds->getAliveConnection();
        $query = "SELECT * FROM banners WHERE title LIKE '%$search%'";
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
    public function insertBanner( $s3ClientObj,$bucketName)
    {
        $conn = $this->ds->getAliveConnection();
        $id = random_int(100000, 999999);
        $newName = $_POST['newName'];
        $newBannerCode = $_POST['newBannerCode'];
       // $newStatus = $_POST['newStatus'];
        $newStartDate = $_POST['newStartDate'];
        $newEndDate = $_POST['newEndDate'];
        $newStatus = 0; 
        if($_POST['newStatus'] ='Active')
        {
            $newStatus = 1;
        }
   
        if (isset($_FILES['Newfile']) && $_FILES['Newfile']['error'] == 0) {
            $file = $_FILES['Newfile'];
    
            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                die("Error: Only JPEG, PNG, and GIF files are allowed.");
            }
            // Generate a unique name for the file
            $key = 'AdminPanel/' . uniqid() . '-' . basename($file['Newfile']);
            //try {
                // Upload the file to S3
                $result = $s3ClientObj->putObject([
                    'Bucket' => $bucketName,
                    'Key'    => $key,
                    'SourceFile' => $file['tmp_name'],
                    'ACL'    => 'public-read', // Make file publicly accessible
                ]);
    
                // File URL
                $url = $result['ObjectURL'];
              
               // echo "File uploaded successfully. <a href='{$url}'>View File</a>";
            /*} catch (AwsException $e) {
                echo "Error uploading file: " . $e->getMessage();
            }*/
        } else {
            echo "Error: " . $_FILES['Newfile']['error'];
        }
       $imgUrl = $url;
    
        $query = "Insert into banners (id,banner_code,title,image_name,image_path,start_date,end_date,status) VALUES (:id,:bannerCode,:bannerTitle,:imageName,:imgPath,:startDate,:endDate,:status)";
        //$sql = "insert into Banners (Id,Name,Status,StartDate,EndDate,ImgUrl) values($Id,'$newName','$newStatus','$newStartDate','$newEndDate','$imgUrl') ";
    
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':bannerCode', $newBannerCode);
        $stmt->bindParam(':bannerTitle', $newName);
        $stmt->bindParam(':imageName', $file['tmp_name']);
        $stmt->bindParam(':imgPath', $imgUrl);
        $stmt->bindParam(':startDate', $newStartDate);
        $stmt->bindParam(':endDate', $newEndDate);
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
            "message" => "Banner created successfully."
        );
       return $response;
    }

     /**
     *
     * @return string[] banner update status message
     */
    public function UpdateBanner( $s3ClientObj,$bucketName)
    {
        $conn = $this->ds->getAliveConnection();
        $id = $_POST['editId'];
        $bannerCode = $_POST['editBannerCode'];
        $bannerName = $_POST['editName'];
        //$editStatus = $_POST['editStatus'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $editStatus = 0; 
        if($_POST['editStatus'] ='Active')
        {
            $editStatus = 1;
        }
        if (isset($_FILES['editfile']) && $_FILES['editfile']['error'] == 0) {
            $file = $_FILES['editfile'];
    
            // Validate file type
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowedTypes)) {
                die("Error: Only JPEG, PNG, and GIF files are allowed.");
            }

            $key = 'AdminPanel/' . uniqid() . '-' . basename($file['editfile']);
    
            //try {
                // Upload the file to S3
                $result = $s3ClientObj->putObject([
                    'Bucket' => $bucketName,
                    'Key'    => $key,
                    'SourceFile' => $file['tmp_name'],
                    'ACL'    => 'public-read', // Make file publicly accessible
                ]);
    
                // File URL
                $url = $result['ObjectURL'];
              
               // echo "File uploaded successfully. <a href='{$url}'>View File</a>";
            /*} catch (AwsException $e) {
                echo "Error uploading file: " . $e->getMessage();
            }*/
        } else {
            echo "Error: " . $_FILES['editfile']['error'];
        }
       $imgUrl = $url;
       
       // $sql = "UPDATE Banners SET Name='$name', Status='$status', StartDate='$startDate',EndDate='$endDate', ImgUrl ='$$imgUrl' WHERE Id='$Id'";
        $query = "UPDATE banners  SET title = :bannerTitle, banner_code=:bannerCode,image_name=:imgName,image_path = :imgPath, status = :status , start_date =:startDate,end_date=:endDate WHERE id = :editId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':editId', $id);
        $stmt->bindParam(':bannerCode', $bannerCode);
        $stmt->bindParam(':bannerTitle', $bannerName);
        $stmt->bindParam(':imgName', $file['tmp_name']);
        $stmt->bindParam(':imgPath', $imgUrl);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':status', $editStatus);
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