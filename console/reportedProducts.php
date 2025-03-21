<?php
session_start();
if (!isset($_SESSION["username"])) {
    $url = "./Home.php";
    header("Location: $url");
    exit();  // Added exit to ensure no further code is executed after redirection
}

session_set_cookie_params(0);

include('./header.php');
require_once __DIR__ . '/Model/reportedProductCls.php';
require_once __DIR__ . '/Model/Member.php';

$productCls = new reportedProductCls();
$search = '';

// Checking if the search parameter is set in the URL
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $result = $productCls->getAllProducts($search);
    // You can remove this debug statement if it's not needed
    // print_r($result);
} else {
    $result = $productCls->getAllProducts($search);
   
}
?>
</html>
<head>
    <link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
    <link href="../console/asset/css/reportedProduct.css" type="text/css" rel="stylesheet" />
    <link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
    <script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
    <div class="MainDiv">
        <div class="topBar">
            <form method="GET" action="">
                <div class="topBarInner">
                    Product Name :
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" >
                    <button class="searchButton" type="submit" name="search-btn">Search</button>
                </div>
            </form>
        </div>
        <div class="productDetailSection">
            <div id="accoundDetailsHeader">
                <div class="col100px">Product Code</div>
                <div class="col150px">Product Name</div>
                <div class="col100px">Reporter Name</div>
                <div class="col150px">Product Owner Name</div> 
                <div class="col100px">Report Date</div> 
                <div class="col100px">Reason</div> 
                <div class="col100px">Status</div> 
            </div>

            <?php if (!empty($result)): ?>
                <?php foreach ($result as $row): ?>
                    <div id="accoundDetailsData">
                        <div class="colData100px"><a href="../console/productDetails.php?id=<?php echo $row['productCode']; ?>" ><?php echo $row['producRefCode']; ?></a></div>
                        <div class="colData150px"><?php echo htmlspecialchars($row['productName']); ?></div>
                        <div class="txtAlignCenter colData100px"><?php echo htmlspecialchars($row['reporterName']); ?></div>
                        <div class="txtAlignCenter colData150px"><?php echo htmlspecialchars($row['productOwnerName']); ?></div>
                        <div class="txtAlignCenter colData100px"><?php echo htmlspecialchars($row['reportDate']); ?></div>
                        <div class="txtAlignCenter colData100px"><?php echo htmlspecialchars($row['reason']); ?></div>
                        <div class="txtAlignCenter colData100px"><?php echo htmlspecialchars($row['status']); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div>No products found matching your search.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
