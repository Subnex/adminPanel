<?php
class UserMgntCls
{

    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds= new DataSource();
    }

    public function getUser($search)
    {
       // $ds = new DataSource();
        $PDOConnection = $this->ds->getAliveConnection();

        if($_SESSION["superAdmin"] == true)
        {
            $query = "SELECT * FROM admin WHERE username  LIKE '%$search%'";
        }
        else
        {
            $query = "SELECT * FROM admin WHERE username  LIKE '%$search%' and super_admin =0";
        }
        $stmt = $PDOConnection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $memberRecord = $stmt->fetchAll();
            //print_r($memberRecord);
        }
       
        return $memberRecord;
    }
     /**
     *
     * @return string[] admin user update status message
     */
    public function updateUserDetails()
    {
        //$DB = new DataSource();
        $conn = $this->ds->getAliveConnection();
        $Id = $_POST['editId'];
        $username = $_POST['editUserName'];
        $editEmail = $_POST['editEmail'];
        $editMobile = $_POST['editUserMobile'];
        $status = 0;
        if($_POST['editStatus'] ='Active')
        {
            $status = 1;
        }
        $sql = "UPDATE admin SET username = :username, mobile=:usermobile,email = :email, status = :status WHERE id = :id";

        $stmt = $conn->prepare($sql);
    
        // Bind parameters
        $stmt->bindParam(':id', var: $Id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $editEmail);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':usermobile', $editMobile);
        
        $response ="";
        // Execute the query
        try{
            $stmt->execute();
            $response = array(
                "status" => "success",
                "message" => "User updated successfully."
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
     /**
     * to add new admin  user
     *
     * @return string[] admin user creation status message
     */
    public function AddNewUser()
    {
        //$DB = new DataSource();
       
        $conn = $this->ds->getAliveConnection();
        $username = $_POST['newUserName'];
        $email = $_POST['newEmail'];
        $pwd = $_POST['newPwd'];
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
        $superUser = 0;
        if($_POST['newUserType'] == true)
        {
            $superUser = 1;
        }
        $userMobile = $_POST['newUserMobile'];
        $userId = random_int(100000, 999999);
        $adminCode =$userId;
        //$userId = random_int(100, 9999);

        $status = 0; 
        if($_POST['newStatus'] ='Active')
        {
            $status = 1;
        }

        $isUsernameExists = $this->isUsernameExist($username);
     
        $isEmailExists = $this->isEmailExist($email);
        $isMobileExists = $this->isMobileExist($userMobile);
        if ($isUsernameExists) {
            $response = array(
                "status" => "error",
                "message" => "Username already exists."
            );
            return $response;
        } else if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email already exists."
            );
            return $response;
        }else if ($isMobileExists) {
            //echo "duplicate mobile found";
            $response = array(
                "status" => "error",
                "message" => "Mobile number already exists."
            );
            return $response;
        } else {
            $query = "Insert into admin (id,admin_code,username,email,mobile,password,status,super_admin) Values(:adminid,:adminCode,:username,:email,:userMobile,:pwd,:status,:superuser)";
            //echo "id=".$userId."=admincode=".$adminCode."=username=".$username."=superuser=".$superUser."=email=".$email."=mobile=".$userMobile."=pwd=".$hashedPassword."=status=".$status;
            
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':adminid', $userId);
            $stmt->bindParam(':adminCode', $adminCode);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':userMobile', $userMobile);
            $stmt->bindParam(':pwd', $hashedPassword);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':superuser', $superUser);
            
            try{
                $stmt->execute();
                $response = array(
                    "status" => "success",
                    "message" => "User created successfully."
                );
                return $response;
            }
            catch(PDOException $e)
            {
                    //print_r($e->getMessage());
                    $response = array(
                        "status" => "Failure",
                        "message" => $e->getMessage()
                    );
                    return $response;
            }
        }

    }
    public function isEmailExist($email)
    {
        $query = "SELECT * FROM admin where email = :email";
        $conn = $this->ds->getAliveConnection();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = false;
        if ($stmt->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }
    public function isMobileExist($mobile)
    {
        $query = "SELECT * FROM admin where mobile = :mobile";
        $conn = $this->ds->getAliveConnection();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->execute();
        $result = false;
        if ($stmt->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }
    public function isUsernameExist($username)
    {
        $query = "SELECT * FROM admin where username = :username";
        $conn = $this->ds->getAliveConnection();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = false;
        if ($stmt->rowCount() > 0) {
            $result = true;
        }
        return $result;
    }
}
?>