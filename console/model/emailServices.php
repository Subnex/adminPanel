<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    // Load Composer's autoloader
    require 'vendor/autoload.php';
class emailServices
{

    private $email;
    public function __construct()
    {
        // Create an instance of PHPMailer
        $this->email = new PHPMailer(true);
        $this->email->isSMTP();                                  // Set mailer to use SMTP
        $this->email->Host       = 'smtp.hostinger.com';           // Specify main and backup SMTP servers
        $this->email->SMTPAuth   = true;                         // Enable SMTP authentication
        $this->email->Username   = 'dev@subnex.in';     // SMTP username
        $this->email->Password   = 'Subnex@9854';              // SMTP password
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, or 'PHPMailer::ENCRYPTION_SMTPS' for SSL
        $this->email->Port       = 587;                          // TCP port to connect to (use 465 for SSL)
    }

    public function getEmailInstance()
    {
        return $this->email;

    }
}
