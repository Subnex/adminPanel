<?php
    
class Member
{

    private $ds;

    function __construct()
    {
        //echo "pass here in member1=";
        require_once __DIR__ . '/../Model/DataSource.php';
        $this->ds = new DataSource();
    }

    /**
     * to check if the username already exists
     *
     * @param string $username
     * @return array
     */
    
    public function getMemberUsingPDO($username) 
    {
        $PDOConnection = $this->ds->getAliveConnection();
        $sql = "SELECT * FROM admin WHERE username = :username";
        $stmt = $PDOConnection->prepare($sql);
        $stmt->bindParam(':username', $username);
        // Execute the query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $memberRecord = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        return $memberRecord;
    }
   

    /**
     * to login a user
     *
     * @return boolean
     */
    public function loginMember()
    {
        $memberRecord = $this->getMemberUsingPDO($_POST["username"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) 
        {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $hashedPassword = $memberRecord["password"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } 
        else 
        {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            session_start();
            $_SESSION["username"] = $memberRecord["username"];
            $_SESSION["superAdmin"]= false;
            $_SESSION["userCode"]= $memberRecord["admin_code"];;
            $_SESSION["LAST_ACTIVE_TIME"]= time();
            if($memberRecord["super_admin"] ==1)
            {
                $_SESSION["superAdmin"] = true;
            }
            $userAuthenticated = true;
            return $userAuthenticated;
        } else if ($loginPassword == 0) {
            $userAuthenticated = false;
            return $userAuthenticated;
        }
        return false;

    }
    public function sendResetPasswordEmail($email) {
        // Check if the email exists in the database
        // Example: using PDO to query the database
        $PDOConnection = $this->ds->getAliveConnection();
        $stmt = $PDOConnection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Generate a password reset token and save it in the database
            $resetToken = bin2hex(random_bytes(16)); // Generate a random reset token
            $PDOConnection->prepare("UPDATE users SET reset_token = ? WHERE email = ?")
                     ->execute([$resetToken, $email]);

            // Send email with the reset link
            $resetLink = "https://yourdomain.com/reset-password.php?token=" . $resetToken;
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: " . $resetLink;
            mail($email, $subject, $message); // You can use a more robust mailer like PHPMailer if necessary

            return true;
        } else {
            return false;
        }
    }
}

