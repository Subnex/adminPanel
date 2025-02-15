<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data 

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $caseNumber = random_int(100000, 999999);
    $st =0;
    //echo "==".$name ."==".$email."==".$message."==".$subject."==".$caseNumber."==".$st."==";
    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    require_once __DIR__ . '/indexCls.php';
   
    $objIndexCls = new indexCls();
    $PDOConnection = $objIndexCls->getAliveConnection();

    $query ="insert into support_cases(case_number,case_owner_name,subject,message,email,status) VALUES (:caseNumber,:ownerName,:subject,:msg,:email,:status)";
    $stmt = $PDOConnection->prepare($query);
   
    
    // Bind parameters
    $stmt->bindParam(':caseNumber', var: $caseNumber);
    $stmt->bindParam(':ownerName', $name);   
    $stmt->bindParam(':subject', var: $subject);
    $stmt->bindParam(':msg', $message);   
    $stmt->bindParam(':email', var: $email);
    $stmt->bindParam(':status', $st);   
    try{
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        echo "error==";
            print_r($e->getMessage());
    }
    echo "Thank you, $name. Your message has been received.";
   
} else {
    echo "Invalid request.";
}


?>