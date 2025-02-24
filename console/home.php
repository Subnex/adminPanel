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
 $caseDetails = $homeCls->FetchCaseDetails();
 $productReqDetails = $homeCls->FetchOutGoingRequestDetails();
 $dealDetails = $homeCls->FetchDealDetails();
 $reqDetails = $homeCls->FetchReqDetails();
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
                    <!-- Product Binding --->
                    <div class="innerHeadDiv">
                        <img src="../console/img/product_listing.gif" class="imgCls" /> Products Details
                        </div>
                        <p>Total Listing  <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalRec']['totalRec']);?></span></p>
                        <p>Active Listing <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>InActive Listing <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Listing <span  style="float: right;margin-right:10px;"><?php print_r( $productDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                        <div class="gotoPageDiv"><a href ="../console/product.php" >Go to Page</a></div>
                    </div>
                     <!-- Category Binding --->
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/category.gif" class="imgCls" /> Category Overview
                        </div>
                        <p>Total Listing <span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalRec']['totalRec']);?></span></p>
                        <p>Active Listing<span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>InActive Listing<span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Listing<span  style="float: right;margin-right:10px;"><?php print_r( $categoryDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                        <div class="gotoPageDiv"><a href ="../console/category.php" >Go to Page</a></div>
                    </div>
                     <!-- User Binding --->
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/professionalUser.gif" class="imgCls" /> Users Details
                        </div>
                        <p>Total User  <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalUser']['totalUser']);?></span></p>
                        <p>Active User <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalActiveUser']['totalActiveUser']);?></span></p>
                        <p>InActive User <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalInActiveUser']['totalInActiveUser']);?></span></p>
                        <p>Today's Registered Users <span  style="float: right;margin-right:10px;"><?php print_r( $userDetails['totalRegUserToday']['totalRegUserToday']);?></span></p>
                 
                        <div class="gotoPageDiv"><a href ="../console/userMgnt.php" >Go to Page</a></div>
                    </div>
                     <!-- Case Binding --->
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/timer.gif" class="imgCls" /> Case Details
                        </div>
                        <p>Total Cases  <span  style="float: right;margin-right:10px;"><?php print_r( $caseDetails['totalRec']['totalRec']);?></span></p>
                        <p>Open Cases <span  style="float: right;margin-right:10px;"><?php print_r( $caseDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>OverDue Cases <span  style="float: right;margin-right:10px;"><?php print_r( $caseDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Cases <span  style="float: right;margin-right:10px;"><?php print_r( $caseDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                 
                        <div class="gotoPageDiv"><a href ="../console/userMgnt.php" >Go to Page</a></div>
                    </div>
                     
                     <!-- Deal Details Binding --->
                     <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/deal.gif" class="imgCls" /> Deal Details
                        </div>
                        <p>Total  Deal  <span  style="float: right;margin-right:10px;"><?php print_r( $dealDetails['totalRec']['totalRec']);?></span></p>
                        <p>Pending Deal <span  style="float: right;margin-right:10px;"><?php print_r( $dealDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>Confirmed Deal <span  style="float: right;margin-right:10px;"><?php print_r( $dealDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Deal <span  style="float: right;margin-right:10px;"><?php print_r( $dealDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                 
                        <div class="gotoPageDiv"><a href ="../console/userMgnt.php" >Go to Page</a></div>
                    </div>
                     <!-- Outgoing request Binding --->
                     <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/prod_req_outgoing.gif" class="imgCls" /> User Request Details
                        </div>
                        <p>Total Outgoing Request  <span  style="float: right;margin-right:10px;"><?php print_r( $productReqDetails['totalRec']['totalRec']);?></span></p>
                        <p>Open Request <span  style="float: right;margin-right:10px;"><?php print_r( $productReqDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>Closed Request <span  style="float: right;margin-right:10px;"><?php print_r( $productReqDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Request <span  style="float: right;margin-right:10px;"><?php print_r( $productReqDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                 
                        <div class="gotoPageDiv"><a href ="../console/userMgnt.php" >Go to Page</a></div>
                    </div>
                    <!-- Product request Binding --->
                    <div class="DetailDivCls">
                        <div class="innerHeadDiv">
                        <img src="../console/img/Productrequest.gif" class="imgCls" /> Request Details
                        </div>
                        <p>Total Request  <span  style="float: right;margin-right:10px;"><?php print_r( $reqDetails['totalRec']['totalRec']);?></span></p>
                        <p>Pending Request <span  style="float: right;margin-right:10px;"><?php print_r( $reqDetails['totalActiveRec']['totalActiveRec']);?></span></p>
                        <p>Approved Request <span  style="float: right;margin-right:10px;"><?php print_r( $reqDetails['totalInActiveRec']['totalInActiveRec']);?></span></p>
                        <p>Today's Request <span  style="float: right;margin-right:10px;"><?php print_r( $reqDetails['totalCreatedTodayRec']['totalCreatedTodayRec']);?></span></p>
                 
                        <div class="gotoPageDiv"><a href ="../console/userMgnt.php" >Go to Page</a></div>
                    </div>
                   
                   
                </div>
        </div> 
        
</body>
</html>