<?php

session_start();
if(isset($_SESSION["LAST_ACTIVE_TIME"])){
   
    if((time() - $_SESSION["LAST_ACTIVE_TIME"]) >20600){
        header('location:logout.php');
        die();
    }
    else
    {
        $_SESSION["LAST_ACTIVE_TIME"] =time();
        //require_once __DIR__ . '/../Model/DataSource.php';
    }
}

?>

<html lang="en">
<link href="../console/asset/css/header.css" type="text/css" rel="stylesheet" /> 
<link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" /> 
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav class="navbar">
          
            <div class="logoCls">
                <img src="../console/img/logo.png" class="logoCls" />
            </div>
          
            <div class="MenuBarCls <?php if(!empty($_SESSION['username'])) { echo 'displayBlock';}else{echo 'displayNone';}?>" >
                 <ul class="nav-links">
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./account.php">Account</a></li>
                    <li><a href="./product.php">Products</a></li>
                    <li><a href="./case.php">Cases</a></li>
                    <li><a href="./category.php">Category</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropbtn">Utility</a>
                        <div class="dropdown-content">
                            <!--<a href="./Notification.php">Notifications</a> -->
                            <a href="./Banner.php">Banner</a>
                            <a href="./errorCode.php">Error Code</a>
                            <a href="./UserMgnt.php">Manage Users</a>
                            <a href="./faq.php">FAQ</a>
                            <a href="./aboutUs.php">About Us</a>
                        </div>
                    </li>
                   
                  
                </ul>
                
            </div>
            <div class="loggedinUserSection <?php if(!empty($_SESSION['username'])) { echo 'displayBlock';}else{echo 'displayNone';}?>">
                <span class="logoutIconCss">
                <?php
                  
                    if(!empty($_SESSION["username"])) 
                    {
                        echo "Welcome ".$_SESSION["username"];
                    }
                ?></span><br/>
                <a id="logoutIcon" class="logoutIconCss" href="./logout.php" title="Logout"> <img src="./img/logout1.png" class="logoutCls"/></a>
            </div>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>
    <script src="script.js"></script>
</body>
<script>
   const mobileMenu = document.getElementById("mobile-menu");
const navLinks = document.querySelector(".nav-links");

mobileMenu.addEventListener("click", () => {
    navLinks.classList.toggle("active");
});

</script>

</html>
