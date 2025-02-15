<?php
//include('/Model/Member.php');
include('./header.php');


if (! empty($_POST["login-btn"])) 
{
    sleep(3);  // Simulating 3 seconds delay (e.g., PHP processing)
    echo '<script>alert("Processing complete!");</script>';

    require_once __DIR__ . '/Model/Member.php';
    $member = new Member();
    //echo "pass here3=";
    $isUserAuthorized = $member->loginMember();
    if($isUserAuthorized)
    {

        session_start();
        session_write_close();
        $url = "./Home.php";
        header("Location: $url");
    }
    else
    {
        echo "<script type='text/javascript'>
        alert('Invalid Username or Password!');
        //window.location.href = 'your_redirect_page.php';
        </script>";
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
     <form name="login" action="" method="post" onsubmit="return loginValidation()">
        <div class ="loginDiv "> 
            <h2>Login</h2>
            <div class="login-section">
            <div  id="resDiv" class="error-msg"></div>
                <?php if(!empty($loginResult)){?>
                        <div  id="resDiv" class="error-msg"></div>
                        <?php }?>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
                <label for="password">Password</label>
                <input type="password" name="login-password" id="login-password" required>
                <div><input class="btn" type="submit" name="login-btn"   id="login-btn" value="Login" onclick="showProcessingIcon()"></div>
            </div>
        </div>
        <img id="loadingSpinner" src="../console/img/spinner.gif" alt="Processing..."> 

        <!-- The overlay (initially hidden) -->
        <div id="overlay">
            <img  id="loadingSpinner" src="../console/img/spinner.gif" alt="Processing...">
        </div>
        <script>
            // Function to show the processing spinner when the button is clicked
            function showProcessingIcon() {
                document.getElementById('overlay').style.display = 'flex'; // Show the overlay
            document.getElementById('loadingSpinner').style.display = 'inline-block'; // Show the spinner
            //document.body.classList.add('blurred');  // Apply blur effect to the page content

                // Simulate a form submission or action (like an AJAX request or a form POST)
                setTimeout(function() {
                    // This is where you'd make an AJAX call or trigger PHP processing
                    // For demonstration, we'll use a timeout to simulate processing
                    document.getElementById('processButton').innerHTML = 'Processing...';
                    
                    // Simulate form submission after a short delay (3 seconds)
                    document.forms[0].submit();  // You can uncomment this line to actually submit the form
                }, 1000);  // Simulate a slight delay before submitting
            }
        </script>
	</form>
</BODY>
</HTML>
