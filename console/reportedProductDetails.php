<?php

session_start();
$uid = '';
if (!isset($_SESSION["username"])) {
    $url = "./Home.php";
    header("Location: $url");
}
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
}
session_set_cookie_params(0);

include('./header.php');
require_once __DIR__ . '/Model/reportedProductDetailsCls.php';
$reportedProdDetails = new reportedProductDetailsCls();
$recid = isset($_GET['id']) ? $_GET['id'] : '';
$prodRec = $reportedProdDetails->getReportedProductsDetails($recid);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            
        
    $res = $reportedProdDetails->updateReportedProductRec();
    $msg = $res['message'];
    echo "<script type='text/javascript'>alert('$msg');</script>";         
    //$sql = "UPDATE Product_Listing SET  Status='$status', Rental_Mode='$editrentalMode' WHERE Id='$Id'";
    //$conn->query($sql);
   // $prodRec = $reportedProdDetails->getReportedProductsDetails($recid);

}  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported Product Details</title>
    <link href="styles.css" type="text/css" rel="stylesheet">
    <style>
        /* Basic CSS for styling the product details page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .product-container {
            width: 99%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .product-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .product-header h1 {
            font-size: 32px;
            color: #333;
        }

        .product-info {
            display: flex;
            justify-content: space-between;
        }

        .product-info img {
            max-width: 300px;
            height: auto;
            border-radius: 8px;
        }

        .product-details {
            width: 60%;
        }

        .product-details h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-details p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .product-details .btn {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-details .btn:hover {
            background-color: #0056b3;
        }

        /* Image Gallery Section */
        .image-gallery {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .image-gallery img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .image-gallery img:hover {
            transform: scale(1.1);
        }

        .full-image {
            width: 100%;
            max-width: 500px;
            display: block;
            margin-top: 20px;
            transition: transform 0.3s ease;
        }

        /* Slider Controls */
        .slider-controls {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        .slider-button {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            margin: 0 10px;
        }

        .slider-button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Zoom Button */
        .zoom-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .zoom-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
            border: none;
        }

        .zoom-button:hover {
            background-color: #0056b3;
        }
        .marginleft17perc{
            margin-left: 17%;
        }
        .imgControlPanel
        {
            border: 0px solid;
            width: 25%;
            margin-left: -3%;
        }
    </style>
</head>
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<body>

    <div class="product-container">

        <!-- Product Information -->
        <div class="product-info">
            <!-- Product Image (Primary Image) -->
            <img src="<?php echo $prodRec['productImgList'][0]['image_path']; ?>" alt="Product Image" id="productImage" class="full-image">
            
            <!-- Product Details -->
            <div class="product-details">
                <h3>Product Name: <span id="productName"><?php echo $prodRec['product'][0]['productName']; ?></span></h3>
                <p><strong>Product Code:</strong> <span id="productCode"><?php echo $prodRec['product'][0]['productCode']; ?></span></p>
                <p><strong>Description:</strong> <span id="productDescription"><?php echo $prodRec['product'][0]['productDesc']; ?></span></p>
                <p><strong>Rental:</strong> <span id="productPrice"><?php echo $prodRec['product'][0]['rental']; ?></span></p>
                <p><strong>Report Reason:</strong> <span id="productPrice"><?php echo $prodRec['product'][0]['reason']; ?></span></p>
                <p><strong>Report Date:</strong> <span id="productPrice"><?php echo $prodRec['product'][0]['reportDate']; ?></span></p>

                <!-- View Image Button -->
                
                <button class="btn" onclick="editProduct('<?php echo $prodRec['product'][0]['id']; ?>')">Take Action</button>
            </div>
        </div>
        <div id="imagecontrolPanel" class="imgControlPanel">
                <!-- Image Gallery (Multiple Images) -->
                <div class="image-gallery">
                    <?php foreach ($prodRec['productImgList'] as $image) { ?>
                        <img src="<?php echo $image['image_path']; ?>" alt="Product Image" onclick="changeImage('<?php echo $image['image_path']; ?>')">
                    <?php } ?>
                </div>

                <!-- Slider Controls (Previous and Next Buttons) 
                <div class="slider-controls">
                    <button class="slider-button" onclick="prevImage()">&#10094;</button>
                    <button class="slider-button" onclick="nextImage()">&#10095;</button>
                </div>-->

                <!-- Zoom Buttons -->
                <div class="zoom-buttons">
                    <button class="zoom-button" onclick="zoomIn()">Zoom In</button>
                    <button class="zoom-button" onclick="zoomOut()">Zoom Out</button>
                </div>
        </div>
    </div>


    <div id="editForm" style="display:none;" class="editFormDiv overlay">
        <div class="popup">
            <div class="popupHeader"><h3>Edit Reported Details</h3></div>
                
                <form method="POST" action="">
                    <input type="hidden" name="editId" id="editId">
                    <label>Response:</label>
                    <input type="text"  name="editResponse" id="editResponse" required><br/><br/>
                    <label>Status:</label>
                    <select id="editStatus" name="editStatus">
                            <option value="Closed">Closed</option>
                            <option value="DeListed">DeListed</option>
                    </select>
                    <div class="popupButtonDiv1"></div>
                        <button type="submit" class="searchButton marginTop10px marginleft17perc" name="update">Update</button>
                        <button type="button" class="searchButton marginTop10px" onclick="closeEditForm()">Cancel</button> <br/><br/>
                    
                </form>
            </div>
    </div>
    <script>
            function editProduct(id) {
                document.getElementById('editId').value = id;
                
                document.getElementById('editForm').style.display = 'block';
                document.getElementById('editForm').style.display = 'flex';
                //alert(rentModeIndex);
                
            }

            function closeEditForm() {
                
                document.getElementById('editForm').style.display = 'none';
            }
        </script>
    <script>
        let currentImageIndex = 0;
        const productImages = <?php echo json_encode($prodRec['productImgList']); ?>;

        // Function to update the main image based on index
        function changeImage(imagePath) {
            document.getElementById('productImage').src = imagePath;
        }

        // Function to automatically slide through the images
        function autoSlider() {
            if (productImages.length > 0) {
                currentImageIndex = (currentImageIndex + 1) % productImages.length;
                document.getElementById('productImage').src = productImages[currentImageIndex].image_path;
            }
        }

        // Function to navigate to the previous image
        function prevImage() {
            if (productImages.length > 0) {
                currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
                document.getElementById('productImage').src = productImages[currentImageIndex].image_path;
            }
        }

        // Function to navigate to the next image
        function nextImage() {
            if (productImages.length > 0) {
                currentImageIndex = (currentImageIndex + 1) % productImages.length;
                document.getElementById('productImage').src = productImages[currentImageIndex].image_path;
            }
        }

        // Start the auto-slider with an interval of 3 seconds
        setInterval(autoSlider, 3000);

       
        // Zoom-In Function
        function zoomIn() {
            let img = document.getElementById('productImage');
            let currentWidth = img.clientWidth;
            img.style.transform = 'scale(' + (currentWidth / 300 + 0.2) + ')'; // Zoom In
        }

        // Zoom-Out Function
        function zoomOut() {
            let img = document.getElementById('productImage');
            let currentWidth = img.clientWidth;
            img.style.transform = 'scale(' + (currentWidth / 300 - 0.2) + ')'; // Zoom Out
        }
    </script>

</body>
</html>
