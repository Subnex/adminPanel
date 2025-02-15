<?php

session_start();

 if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    include('./header.php');
    require_once __DIR__ . '/Model/homeCls.php';
    $homeCls = new homeCls();
 } else {
     session_unset();
     session_write_close();
     $url = "./index.php";
     header("Location: $url"); 
 }
 $userDetails = $homeCls->getAllAccount();


 $productDetails = $homeCls->FetchProductDetails();
 $categoryDetails = $homeCls->FetchCategoryDetails();
 //$productDetails = $products['details']; 
 //print_r($categoryDetails['totalRec']);
     
?>
<html>
    <title>Home</title>
    <head>
<link href="../console/asset/css/home.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>

        <div class="main-container">   
                <div class="DetailDivCls">
                    <div class="innerHeadDiv">
                    <img src="../console/img/checklist.gif" class="imgCls" /> Products Details
                    </div>
                    <p>Total Listing  <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalRec']['totalRec']);?></span></p>
                    <p>Active Listing <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                    <p>InActive Listing <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                    <p>Today's Listing <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                    <div class="gotoPageDiv"><a href ="../console/product.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/banner.gif" class="imgCls" /> Category Overview
                        </div>
                        <p>Total Listing <span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalRec']['totalRec']);?></span></p>
                        <p>Active Listing<span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>InActive Listing<span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Listing<span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                        <div class="gotoPageDiv"><a href ="../console/case.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/user.gif" class="imgCls" /> Users Details
                        </div>
                        <p>Total User  <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalUser']['totalUser']);?></span></p>
                        <p>Active User <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalActiveUser']['totalActiveUser']);?></span></p>
                        <p>InActive User <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalInActiveUser']['totalInActiveUser']);?></span></p>
                        <p>Today's Registered Users <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalRegUserToday']['totalRegUserToday']);?></span></p>
                 
                        <div class="gotoPageDiv"><a href ="../console/userMgnt.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                    <div class="innerHeadDiv2">
                    <img src="../console/img/message.gif" class="imgCls" /> Case Details
                    </div>
                    <p>Total Category :15</p>
                    <p>Active Category :12</p>
                    <p>InActive Category :3</p>
                    <div class="gotoPageDiv"><a href ="../console/category.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv2">
                        <img src="../console/img/banner.gif" class="imgCls" /> Banner Details
                        </div>
                        <p>Total Banner :10</p>
                        <p>Active Listing :5</p>
                        <p>InActive Listing :5</p>
                        <div class="gotoPageDiv"><a href ="../console/banner.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv2">
                        <img src="../console/img/computer.gif" class="imgCls" /> Error Code Details
                        </div>
                        <p>Total Code :<?php echo $totalRecords;?></p>
                        <p>Active Listing :2342</p>
                        <p>InActive Listing :7567</p>
                        <div class="gotoPageDiv"><a href ="../console/errorCode.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv2">
                        <img src="../console/img/banner.gif" class="imgCls" /> Raise Request Details
                        </div>
                        <p>Total Request :10</p>
                        <p>Active Request :5</p>
                        <p>Today'sRequest :5</p>
                        <div class="gotoPageDiv"><a href ="../console/banner.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv2">
                        <img src="../console/img/computer.gif" class="imgCls" /> Deal Details
                        </div>
                        <p>Total Deals :<?php echo $totalRecords;?></p>
                        <p>In Progess  :2342</p>
                        <p>Closed :7567</p>
                        <p>Today's Deal :7567</p>
                        <div class="gotoPageDiv"><a href ="../console/errorCode.php" >Go to Page</a></div>
                    </div>
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv2">
                        <img src="../console/img/computer.gif" class="imgCls" /> Product Request Details
                        </div>
                        <p>Total Request :<?php echo $totalRecords;?></p>
                        <p>Accepted  :2342</p>
                        <p>Pending :7567</p>
                        <p>Rejected :7567</p>
                        <div class="gotoPageDiv"><a href ="../console/errorCode.php" >Go to Page</a></div>
                    </div>
                </div>
        </div> 
        
</body>
</html>