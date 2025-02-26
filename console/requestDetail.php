<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: ./Home.php");
    exit();
}

// Include necessary files for database connection
include('./header.php'); // Assuming header.php contains database connection setup and other common parts
require_once __DIR__ . '/Model/DataSource.php'; // Path to your database class

// Get the request_id from the URL
$request_id = isset($_GET['request_id']) ? $_GET['request_id'] : '';

// Check if request_id is provided
if (!$request_id) {
    echo "Invalid request ID.";
    exit();
}

// Initialize the DataSource class
$DB = new DataSource();
$PDOConnection = $DB->getAliveConnection();

// Fetch request details from the database based on the request_id
$query = "SELECT r.id, r.request_by, r.product_code, r.request_status, r.created_at, 
                 u.username as requester_name, p.name as product_name
          FROM requests r
          JOIN users u ON r.request_by = u.user_code
          JOIN products p ON r.product_code = p.product_code
          WHERE r.id = ?";
$stmt = $PDOConnection->prepare($query);
$stmt->execute([$request_id]);

// Fetch the result
$request_details = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the request details are found
if ($request_details) {
    // Display the request details in HTML format
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Request Details</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f9f9f9;
            }
            .request-details {
                background-color: #fff;
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .request-details h2 {
                margin-bottom: 20px;
            }
            .request-details table {
                width: 100%;
                border-collapse: collapse;
            }
            .request-details table, th, td {
                border: 1px solid #ddd;
            }
            th, td {
                padding: 8px;
                text-align: left;
            }
        </style>
    </head>
    <body>

    <p><a href="productDetails.php/id=">Go Back to Request List</a></p>  <!-- Modify the link to your requests list page -->

        <div class="request-details">
            <h2>Request Details</h2>
            <table>
                <tr>
                    <th>Request ID</th>
                    <td><?php echo htmlspecialchars($request_details['id']); ?></td>
                </tr>
                <tr>
                    <th>Requester Name</th>
                    <td><?php echo htmlspecialchars($request_details['requester_name']); ?></td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td><?php echo htmlspecialchars($request_details['product_name']); ?></td>
                </tr>
                <tr>
                    <th>Request Status</th>
                    <td><?php echo htmlspecialchars($request_details['request_status']); ?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?php echo htmlspecialchars($request_details['created_at']); ?></td>
                </tr>
            </table>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "Request not found.";
}
?>
