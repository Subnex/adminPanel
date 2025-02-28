<?php

    session_start();
    $uid='';
    if (!isset($_SESSION["username"]))
    {
        $url = "./Home.php";
        header("Location: $url");
    }
    if (isset($_GET['uid'])) {
        $uid = $_GET['uid'];
        //echo "catCode=: " . htmlspecialchars($catCode);
    }
    session_set_cookie_params(0);

    include('./header.php');
    require_once __DIR__ . '/Model/productDetailCls.php';
     $prodDetails = new productDetailCls();
    $productCode = isset($_GET['id']) ? $_GET['id'] : '';
    $prodRec = $prodDetails->getProductsDetails($productCode);
    //print_r($prodRec["productImg"][0]['image_path']);
    // Function to render a table
    function renderTable($data, $columns, $headers, $link_column = 'id') {
        if (!empty($data)) {
            echo '<table>';
            echo '<thead><tr>';
            
            // Loop through the headers and display them
            foreach ($headers as $header) {
                echo '<th>' . htmlspecialchars($header) . '</th>';
            }
            echo '</tr></thead><tbody>';
            
            // Loop through the data and display each row
            foreach ($data as $row) {
                echo '<tr>';
                
                // Loop through each column and display the data
                foreach ($columns as $column) {
                    // Check if the column is the one that should be a link (e.g., id)
                    if ($column == $link_column) {
                        // Generate a link for the ID column
                        echo '<td><a href="requestDetail.php?request_id=' . htmlspecialchars($row[$column]) . '">' . htmlspecialchars($row[$column]) . '</a></td>';
                    } else{
                        // For date fields, convert to dd-mm-yyyy format
                        if (strpos($column, 'date') !== false || strpos($column, 'created_at') !== false || strpos($column, 'startDate') !== false || strpos($column, 'endDate') !== false) {
                            // Assuming the date is in the format Y-m-d H:i:s, adjust if necessary
                            echo '<td>' . formatDate($row[$column]) . '</td>';
                        } else {
                            // For other columns, just display the value
                            echo '<td>' . htmlspecialchars($row[$column]) . '</td>';
                        }
                    }
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No data found.</p>';
        }
    }
    // Function to format the date into dd-mm-yyyy format
function formatDate($date) {
    if (empty($date)) return '';

    // If the date is valid, format it
    try {
        $datetime = new DateTime($date);
        return $datetime->format('d-m-Y');
    } catch (Exception $e) {
        // If date is invalid, return original value or empty
        return $date;
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .product-card h4 {
            margin: 10px 0;
        }
        .DetailDivCls
        {
            min-height: 150px;
            max-height: 350px;
            width: 100%;
            background-color: #fff;
            border: 1px solid #f2eeee;
            border-radius: 5px;
            margin-top: 10px;
            float: left;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: auto;

        }
        .innerHeadDiv2
        {
            height: 35px;
            width: 100%;
            /* background-color: #337ab7; */
            color: #1373ac;
            padding-left: 1%;
            font-size: 22px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom: 1px solid orange; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border-bottom: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .profile-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-details {
            flex: 1;
        }

        .product-info {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Creates two columns */
            gap: 20px; /* Adds space between columns */
        }

        .product-info-item {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .product-info-item strong {
            color: #1373ac; /* Makes the labels stand out */
        }
    </style>
</head>
<body>

<div class="profile-container">
    <img src="<?php echo htmlspecialchars($prodRec["productImg"][0]['image_path']); ?>" alt="Product Image">
    <div class="profile-details">
        <div class="product-info">
            <div class="product-info-item">
                <strong>Product Name:</strong> <?php echo htmlspecialchars($prodRec['product']['name']); ?>
            </div>
            <div class="product-info-item">
                <strong>Price:</strong> <?php echo htmlspecialchars($prodRec['product']['list_price']); ?>
            </div>
            <div class="product-info-item">
                <strong>Status:</strong> <?php echo htmlspecialchars($prodRec['product']['status']); ?>
            </div>
            <div class="product-info-item">
                <strong>Description:</strong> <?php echo htmlspecialchars($prodRec['product']['description']); ?>
            </div>
            <div class="product-info-item">
                <strong>Category:</strong> <?php echo htmlspecialchars($prodRec['product']['category']); ?>
            </div>
            <div class="product-info-item">
                <strong>Available Stock:</strong> <?php echo htmlspecialchars($prodRec['product']['stock']); ?>
            </div>
            <div class="product-info-item">
                <strong>Rating:</strong> <?php echo htmlspecialchars($prodRec['product']['rating']); ?>
            </div>
        </div>
    </div>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>Pending Requests</h4></div>
    <?php
    $pendingColumns = ['id', 'username', 'name', 'request_status', 'created_at'];
    $pendingHeaders = ['Request ID', 'User Name', 'Product Name', 'Status', 'Request Date'];
    renderTable($prodRec['pending_requests'], $pendingColumns, $pendingHeaders);
    ?>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>Approved Requests</h4></div>
    <?php
    $approvedColumns = ['id', 'username', 'name', 'request_status', 'created_at'];
    $approvedHeaders = ['Request ID', 'User Name', 'Product Name', 'Status', 'Request Date'];
    renderTable($prodRec['approved_requests'], $approvedColumns, $approvedHeaders);
    ?>
</div>

<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>Deals Details</h4></div>
    <?php
    $dealsColumns = ['order_no', 'OpterName', 'ListerName', 'order_type', 'rentMode', 'actualPrice', 'finalPrice', 'startDate', 'endDate'];
    $dealsHeaders = ['Order No.', 'Opter Name', 'Lister Name', 'Order Type', 'Rent Mode', 'Rental', 'Final Price', 'Deal Start Date', 'Deal End Date'];
    renderTable($prodRec['deals'], $dealsColumns, $dealsHeaders);
    ?>
</div>

</body>
</html>
