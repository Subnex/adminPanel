<?php
class accountCls
{

    private $DB; 
    public function __construct()
    {
        require_once __DIR__ . '/../Model/DataSource.php'; 
        $this->DB= new DataSource();
    }

    public function getAllAccount($search) 
    {
        $PDOConnection = $this->DB->getAliveConnection();
        $query = "SELECT * FROM users WHERE (first_name LIKE '%$search%' or last_name LIKE '%$search%' or user_publisher_id LIKE '%$search%') ";
        
        $stmt = $PDOConnection->prepare($query);
        try{
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            print_r($e->getMessage());
        }
        if ($stmt->rowCount() > 0) {
            $accountRecords = $stmt->fetchAll();
        }
       
        return $accountRecords;
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

     /**
     *
     * @return string[] banner update status message
     */
    public function updateAccountDetails()
    {
        $conn = $this->DB->getAliveConnection();
        $Id = $_POST['editId'];
        $userName = $_POST['editUserName'];
        $dob = $_POST['editDOB'];
        $accStatus = 0;
       // echo "id==".$Id;
       //print_r($userName);
      // print_r($dob);
      
        if($_POST['editStatus'] =='Active')
        {
            $accStatus = 1;
        }
        //print_r($accStatus);

       // $sql = "UPDATE users SET username=:userName, status =:acstatus, date_of_birth=:dob WHERE user_publisher_id:recId";
       $query = "UPDATE users SET username=:uname,status=:accStatus,date_of_birth=:accDOB WHERE user_publisher_id=:recID";

        $stmt = $conn->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':recID', var: $Id);
        $stmt->bindParam(':uname', $userName);
        $stmt->bindParam(':accDOB', $dob);
        $stmt->bindParam(':accStatus', $accStatus);
        
        $response ="";
        // Execute the query
        try{
            $stmt->execute();
            $response = array(
                "status" => "success",
                "message" => "Account Details updated successfully."
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