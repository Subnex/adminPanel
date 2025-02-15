<?php
class ErrorCodeCls
{

    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php'; 
        $this->ds= new DataSource();
    }

    public function getAllErrorCodes($search)
    {
        $PDOConnection = $this->ds->getAliveConnection();
        $query = "SELECT * FROM error_codes WHERE error_code  like '%$search%' OR error_Message LIKE '%$search%'";
        //print_r($query);
        if($search == null)
        {
            $query = "SELECT * FROM error_codes ";
        }
        
        // print_r($query);
        $stmt = $PDOConnection->prepare($query);

        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
                print_r($e->getMessage());
        }
        if ($stmt->rowCount() > 0) {
            $errorRecords = $stmt->fetchAll();
        }
       
        return $errorRecords;
    }
    /**
     *
     * @return string[] banner update status message
     */
    public function insertErrorCode()
    {
       $conn = $this->ds->getAliveConnection();
       $errorCode = $_POST['NewCode'];
       $errormsg = $_POST['Errormsg'];
       $errorId = random_int(100000, 999999);
       $status = 0; 
        if($_POST['newStatus'] ='Active')
        {
            $status = 1;
        }
        $query = "Insert into error_codes (error_code,error_message,status) Values(:errorCode,:errorMsg,:status)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':errorCode', $errorCode);
        $stmt->bindParam(':errorMsg', $errormsg);
        $stmt->bindParam(':status', $status);
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
                print_r($e->getMessage());
        }
        $response = array(
            "status" => "success",
            "message" => "Error Code created successfully."
        );
        //echo "==passing from here3===";
        return $response;
    }
    /**
     *
     * @return string[] banner update status message
     */
    public function UpdateErrorCode()
    {
        $conn = $this->ds->getAliveConnection();
        $Id = $_POST['editId'];
        $errorCode = $_POST['editCode'];
        $errormsg = $_POST['editErrorText'];
        $status = 0;
        if($_POST['editStatusId'] ='Active')
        {
            $status = 1;
        }
        $sql = "UPDATE error_codes SET error_code = :errorCode, error_message=:errormsg,status = :status WHERE id = :id";

        $stmt = $conn->prepare($sql);
    
        // Bind parameters
        $stmt->bindParam(':id', var: $Id);
        $stmt->bindParam(':errorCode', $errorCode);
        $stmt->bindParam(':errormsg', $errormsg);
        $stmt->bindParam(':status', $status);
        
        $response ="";
        // Execute the query
        try{
            $stmt->execute();
            $response = array(
                "status" => "success",
                "message" => "Error record updated successfully."
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