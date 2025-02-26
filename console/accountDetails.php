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
    require_once __DIR__ . '/Model/accountDetailsCls';
    $accDetails = new accountDetailsCls();
    $accId = isset($_GET['id']) ? $_GET['id'] : '';
    $accRec = $accDetails->getAccountDetails($accId);
    //print_r($accRec["productImg"][0]['image_path']);
    // Function to render a table
    function renderTable($data, $columns, $headers, $link_column = 'productCode') {
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
                        echo '<td><a href="productDetails.php?id=' . htmlspecialchars($row[$column]) . '">' . htmlspecialchars($row[$column]) . '</a></td>';
                    } else {
                        // For other columns, just display the value
                        echo '<td>' . htmlspecialchars($row[$column]) . '</td>';
                    }
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No data found.</p>';
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
            height: 255px;
            width: 100%;
            background-color: #fff;
            border: 1px solid #f2eeee;
            border-radius: 5px;
            margin-top: 10px;
            float: left;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Enables vertical scrolling */
            padding: 10px; /* Optional padding */

        }
        .innerHeadDiv2
        {
            height: 25px;
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
            position: relative; /* Ensure proper positioning for sticky header */
        }

        th {
            background-color: #1373ac; /* Optional: Add background color to the header */
            position: sticky;
            top: 0; /* Keeps the header at the top of the table */
            z-index: 1; /* Ensures the header is above the body when scrolling */
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        thead {
            background-color: #f9f9f9; /* Optional: Gives the header a background color */
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
    <div class="innerHeadDiv2"><h4>My Lising</h4></div>
    <?php
    $pendingHeaders= ['Product Code', 'Name', 'Rental Amount', 'Late Charges', 'Status'];
    $pendingColumns = ['productCode', 'pName', 'list_price', 'late_fee', 'product_status'];
    renderTable($accRec['my_listing'], $pendingColumns, $pendingHeaders);
    ?>
</div>
<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Deals</h4></div>
    <?php
    $dealsColumns = ['order_no', 'OpterName', 'ListerName', 'order_type', 'rentMode', 'actualPrice', 'finalPrice', 'startDate', 'endDate'];
    $dealsHeaders = ['Order No.', 'Opter Name', 'Lister Name', 'Order Type', 'Rent Mode', 'Rental', 'Final Price', 'Deal Start Date', 'Deal End Date'];
    renderTable($accRec['deals'], $dealsColumns, $dealsHeaders);
    ?>
</div>
<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Requests</h4></div>
    <?php
    $approvedColumns = ['id', 'username', 'name', 'request_status', 'created_at'];
    $approvedHeaders = ['Request ID', 'User Name', 'Product Name', 'Status', 'Request Date'];
    renderTable($accRec['approved_requests'], $approvedColumns, $approvedHeaders);
    ?>
</div>
<div class="DetailDivCls">
    <div class="innerHeadDiv2"><h4>My Outgoing Request</h4></div>
    <?php
    $dealsColumns = ['order_no', 'OpterName', 'ListerName', 'order_type', 'rentMode', 'actualPrice', 'finalPrice', 'startDate', 'endDate'];
    $dealsHeaders = ['Order No.', 'Opter Name', 'Lister Name', 'Order Type', 'Rent Mode', 'Rental', 'Final Price', 'Deal Start Date', 'Deal End Date'];
    renderTable($accRec['deals'], $dealsColumns, $dealsHeaders);
    ?>
</div>

</body>
</html>
