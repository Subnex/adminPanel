<?php
session_start();

function checkSession() {
    if (!isset($_SESSION["username"])) {
        header("Location: ./Home.php");
        exit;
    }
}

checkSession();  // Ensure the user is logged in

$uid = $_GET['uid'] ?? ''; // Use null coalescing operator

session_set_cookie_params(0);  // This could be redundant unless there's a specific reason for it.

include('./header.php');
require_once __DIR__ . '/Model/accountDetailsCls.php';

$accDetails = new accountDetailsCls();
$accId = $_GET['id'] ?? '';  // Get account ID or set to empty if not set
$accRec = $accDetails->getAccountDetails($accId);

// General function to render tables
function renderTable($data, $columns, $headers, $link_column = 'productRefCode', $id_field = 'productCode') {
    if (empty($data)) {
        echo '<p>No data found.</p>';
        return;
    }

    echo '<table>';
    echo '<thead><tr>';
    foreach ($headers as $header) {
        echo '<th>' . htmlspecialchars($header) . '</th>';
    }
    echo '</tr></thead><tbody>';

    foreach ($data as $row) {
        echo '<tr>';
        foreach ($columns as $column) {
            if ($column == $link_column) {
                $goToId = ($link_column == 'productRefCode') ? $row[$id_field] : $row[$column];
                echo '<td><a href="productDetails.php?id=' . htmlspecialchars($goToId) . '">' . htmlspecialchars($row[$column]) . '</a></td>';
            } else {
                echo '<td>' . htmlspecialchars($row[$column]) . '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../console/asset/css/accountDetails.css" type="text/css" rel="stylesheet" />
    <link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
    <script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
    <title>User Profile</title>
</head>
<body>

<div class="profile-container">
    <img src="<?php echo htmlspecialchars($accRec["user"]['profile_image']); ?>" alt="User Image">
    <div class="profile-details">
        <div class="product-info">
            <div class="product-info-item">
                <strong>User Name:</strong> <?php echo htmlspecialchars($accRec['user']['username']); ?>
            </div>
            <div class="product-info-item">
                <strong>Email:</strong> <?php echo htmlspecialchars($accRec['user']['email']); ?>
            </div>
            <div class="product-info-item">
                <strong>DOB:</strong> <?php echo htmlspecialchars($accRec['user']['date_of_birth']); ?>
            </div>
            <div class="product-info-item">
                <strong>Mobile:</strong> <?php echo htmlspecialchars($accRec['user']['mobile']); ?>
            </div>
            <div class="product-info-item">
                <strong>Gender:</strong> <?php echo htmlspecialchars($accRec['user']['gender']); ?>
            </div>
            <div class="product-info-item">
                <strong>Status:</strong> <?php echo htmlspecialchars($accRec['user']['status']); ?>
            </div>
            <div class="product-info-item">
                <strong>Rating:</strong> <?php echo htmlspecialchars($accRec['user']['rating']); ?>
            </div>
        </div>
    </div>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Listing</h4></div>
    <?php
    $pendingHeaders = ['Product Code', 'Name', 'Rental Amount', 'Late Charges', 'Status'];
    $pendingColumns = ['productRefCode', 'pName', 'list_price', 'late_fee', 'product_status'];
    renderTable($accRec['my_listing'], $pendingColumns, $pendingHeaders);
    ?>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Deals</h4></div>
    <?php
    $dealsColumns = ['order_no', 'productName', 'listerName', 'opterName', 'order_type', 'rentMode', 'actulaPrice', 'finalPrice', 'startDate', 'endDate'];
    $dealsHeaders = ['Order no.', 'Product name', 'Lister Name', 'Opter Name', 'Order Type', 'Rent Mode', 'Rental', 'Final Price', 'Deal Start Date', 'Deal End Date'];
    renderTable($accRec['myDeals'], $dealsColumns, $dealsHeaders, 'order_no', 'order_code');
    ?>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Requests</h4></div>
    <?php
    $approvedColumns = ['reqId', 'productName', 'productOwner', 'reqStatus', 'reqDate'];
    $approvedHeaders = ['Request ID', 'Product Name', 'Product Owner', 'Status', 'Request Date'];
    renderTable($accRec['request'], $approvedColumns, $approvedHeaders, 'reqId', 'request_code');
    ?>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Outgoing Request</h4></div>
    <?php
    $outgoingColumns = ['reqId', 'description', 'duration', 'category', 'subCategory', 'rental', 'reqStatus', 'startDate', 'endDate'];
    $outgoingHeaders = ['Id', 'Description', 'Duration', 'Category', 'Sub Category', 'Rental', 'Status', 'Deal Start Date', 'Deal End Date'];
    renderTable($accRec['OutGoingRequest'], $outgoingColumns, $outgoingHeaders, 'reqId');
    ?>
</div>

</body>
</html>
