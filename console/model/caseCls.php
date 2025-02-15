<?php
class caseCls{

    private $ds;
    public function __construct(){
        require_once __DIR__ . '/../Model/DataSource.php';
        
        $this->ds= new DataSource();
    }
 
    public function getCases($search)
    {
        
        $PDOConnection = $this->ds->getAliveConnection();
        $query = "SELECT * FROM support_cases WHERE (subject LIKE '%$search%' or case_owner_name LIKE '%$search%' OR message LIKE '%$search%' OR case_number LIKE '%$search%') AND status=0";
        
       // $accountRec = $this->DB->select($query, $paramType, $paramValue);
        //return $accountRec;
       
        $stmt = $PDOConnection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $caseRecords = $stmt->fetchAll();
            //print_r($memberRecord);
        }
        return $caseRecords;
    }

    /**
     *
     * @return string[] reply on a case
     */
    public function replyOnCase()
    {
        $conn = $this->ds->getAliveConnection();
        $caseNumber = $_POST['replyId'];
        $subject = $_POST['replySubject'];
        $emailId = $_POST['replyEmail'];
        $msg = $_POST['replyMsg'];

          $mailCls = new emailServices();
          $mail = $mailCls->getEmailInstance();
         // Retrieve form inputs
            //$caseId = htmlspecialchars($_POST['case_id']);
            $recipientEmail = $emailId;
            $replyContent = htmlspecialchars_decode($msg);
            // Validate email address
            if (!$recipientEmail) {
                die("Invalid email address.");
            }

            // Email subject and body
            $subject = "Reply from SubNex: $caseNumber";
            $message = "
                <html>
                <head>
                    <title>Reply from SubNex: $caseNumber</title>
                </head>
                <body>
                    <p>$replyContent</p>
                </body>
                </html>
            ";
            // Recipients
            $mail->setFrom('dev@subnex.in', 'Subnex Support');
            $mail->addAddress($recipientEmail); // Add a recipient
            // $mail->addReplyTo('info@example.com', 'Information');    // Optional reply-to address
            // $mail->addCC('cc@example.com');                           // Optional CC
            // $mail->addBCC('bcc@example.com');                         // Optional BCC

            // Attachments (Optional)
            // $mail->addAttachment('/path/to/file.txt');               // Add attachments
            // $mail->addAttachment('/path/to/image.jpg', 'new.jpg');   // Optional name for the attachment

            // Content
            $mail->isHTML(true);                                     // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
        // $mail->AltBody = 'This is the plain text for non-HTML mail clients';
            $mail->send();

            $sql = "insert into case_replies(case_number,subject,email,message) VALUES (:caseNumber , :subject,:email, :msg)";

            $stmt = $conn->prepare($sql);
            // Bind parameters
            $stmt->bindParam(':caseNumber', $caseNumber);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':email', $emailId);
            $stmt->bindParam(':msg', $message);
            
            $response ="";
            // Execute the query
            try{
                $stmt->execute();
                $response = array(
                    "status" => "success",
                    "message" => "Replied  successfully."
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
            $sql = "UPDATE support_cases SET status = :caseStatus WHERE case_number = :caseNumber";

            $stmt = $conn->prepare($sql);
        
            // Bind parameters
            $caseStatus =1;
            $stmt->bindParam(':caseNumber', var: $caseNumber);
            $stmt->bindParam(':caseStatus',$caseStatus);        
            $response ="";
            // Execute the query
            try{
                $stmt->execute();
                $response = array(
                    "status" => "success",
                    "message" => "Case updated successfully."
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