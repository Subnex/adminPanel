<?php
//include('/Model/Member.php');
include('./header.php');

// Handle Login
if (!empty($_POST["login-btn"])) {
    sleep(3);  // Simulating 3 seconds delay (e.g., PHP processing)
    echo '<script>alert("Processing complete!");</script>';

    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    $isUserAuthorized = $member->loginMember();
    if($isUserAuthorized) {
        session_start();
        session_write_close();
        $url = "./Home.php";
        header("Location: $url");
    } else {
        echo "<script type='text/javascript'>
        alert('Invalid Username or Password!');
        </script>";
    }
}

// Handle Forgot Password Request
if (!empty($_POST["reset-password-btn"])) {
    $email = $_POST['email'];

    // Assume we have a function to handle sending the reset password email
    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    
    if ($member->sendResetPasswordEmail($email)) {
        echo "<script>alert('Password reset link has been sent to your email address.');</script>";
    } else {
        echo "<script>alert('Email not found. Please try again.');</script>";
    }
}
?>

<HTML>
<HEAD>
<TITLE>Login</TITLE>
<link href="../console/asset/css/login.css" type="text/css" rel="stylesheet" /> 
<link href="../console/asset/css/spinner.css" type="text/css" rel="stylesheet" /> 
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>
<BODY>
    <!-- Login Form -->
    <form name="login" action="" method="post" onsubmit="return loginValidation()">
        <div class="loginDiv"> 
            <h2>Login</h2>
            <div class="login-section">
                <div id="resDiv" class="error-msg"></div>
                <?php if(!empty($loginResult)){?>
                    <div id="resDiv" class="error-msg"></div>
                <?php }?>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
                <label for="password">Password</label>
                <input type="password" name="login-password" id="login-password" required>
                <div><input class="btn" type="submit" name="login-btn" id="login-btn" value="Login" onclick="showProcessingIcon()"></div>
                <!-- Forgot Password link -->
                <div><a href="javascript:void(0);" onclick="showResetPasswordForm()">Forgot Password?</a></div>
            </div>
        </div>
        <img id="loadingSpinner" src="../console/img/spinner.gif" alt="Processing..."> 

        <!-- The overlay (initially hidden) -->
        <div id="overlay">
            <img id="loadingSpinner" src="../console/img/spinner.gif" alt="Processing...">
        </div>
    </form>

    <!-- Reset Password Form (initially hidden) -->
    <div id="resetPasswordDiv" style="display:none;">
        <h2>Reset Your Password</h2>
        <form name="resetPassword" action="" method="post">
            <div class="login-section">
                <label for="email">Enter your email address:</label>
                <input type="email" name="email" id="email" required>
                <div><input class="btn" type="submit" name="reset-password-btn" id="reset-password-btn" value="Reset Password"></div>
            </div>
        </form>
    </div>

    <script>
        // Function to show the processing spinner when the button is clicked
        function showProcessingIcon() {
            document.getElementById('overlay').style.display = 'flex'; // Show the overlay
            document.getElementById('loadingSpinner').style.display = 'inline-block'; // Show the spinner
        }

        // Function to show the reset password form
        function showResetPasswordForm() {
            document.querySelector('form[name="login"]').style.display = 'none';
            document.getElementById('resetPasswordDiv').style.display = 'block';
        }
    </script>
</BODY>
</HTML>
