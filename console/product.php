
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
        session_set_cookie_params(0);
       //commit from rahul
        include('./header.php');
        require_once __DIR__ . '/Model/productCls.php';
        require_once __DIR__ . '/Model/Member.php';
        $productCls = new productCls();
        //$DB = new DataSource();
        //$conn = $DB->getConnection();
        $search = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            
        
            $res = $productCls->updateproductDetails();  
            $msg = $res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>";         
            //$sql = "UPDATE Product_Listing SET  Status='$status', Rental_Mode='$editrentalMode' WHERE Id='$Id'";
            //$conn->query($sql);
            $result = $productCls->getAllProducts($search);
    
        }  
        
        
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $result = $productCls->getAllProducts($search);
    
        }
        else
        {
           // $productCls->getAllProducts($search);
            $result = $productCls->getAllProducts($search); 
             // Display the resulting array
            //echo "<pre>";
            //print_r($result);
            //echo "</pre>";
        }
        
   ?>
</html>
<head>
<link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/product.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body> 
        <div class="MainDiv">
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner">Product Name :
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" >
                    <button class="searchButton" type="submit" name="search-btn" >Search</button>
                    <!--<button class="searchButton" type="submit" name="search-flag-btn">Fetch All</button>
                    <button  class="searchButton" name="addNew" onclick="AddNewBanner();return false;">Add New</button> -->
                </form>
            </div>
            <div class ="productDetailSection">
                <div id="accoundDetailsHeader">
                    <div class="col1">Product Code</div>
                    <div class="col2">Product Name</div>
                    <div class="col1">Category</div>
                    <div class="col1">Sub Category</div>
                    <div class="col1">Owner Name</div> 
                    <div class="col1">Rental Mode</div> 
                    <div class="col1">Rental Prices(INR)</div> 
                    <div class="col1">Status</div>
                    <div class="col3">Action</div>
                </div>
             
              
                <?php foreach($result as $row) {?>
                    <div id="accoundDetailsData">
                            <Div class="txtAlignCenter colData1"><a href="../console/productDetails.php?id=<?php echo $row['product_ref_code']; ?>" ><?php echo $row['product_ref_code']; ?></a></Div>
                            <Div class="colData2"><?php echo $row['name']; ?></Div>
                            <Div class="colData1" ><?php echo  $row['category_name']; ?></Div> 
                            <Div class="txtAlignCenter colData1"><?php echo $row['sub_category_name']; ?></Div>
                            <Div class="txtAlignCenter colData1" ><?php echo $row['user_publisher_id']; ?></Div>
                            <Div class="txtAlignCenter colData1"><?php echo $row['rent_mode_code']; ?></Div>
                            <Div class="txtAlignCenter colData1"><?php echo $row['list_price']; ?></Div>
                            <Div class="txtAlignCenter colData1"><?php echo $row['status']; ?></Div>
                            <Div class="txtAlignCenter colData3">
                                <button onclick="editProduct('<?php echo $row['product_code']; ?>', '<?php echo addslashes($row['name']); ?>', '<?php echo $row['category_name']; ?>', '<?php echo $row['sub_category_name']; ?>','<?php echo addslashes($row['rent_mode_code']);?>','<?php echo addslashes($row['list_price']);?>','<?php echo addslashes($row['status']); ?>')"><img src="img/edit.png" height="18px" width="18px" /></button>
                            </Div>
                    </div>  
                    <?php }; ?> 
              
            </div>
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                    <div class="popupHeader"><h3>Edit Product Details</h3></div>
                        
                        <form method="POST" action="">
                            <input type="hidden" name="editId" id="editId">
                            <label>Name:</label>
                            <input type="text" readonly="false" name="editProductname" id="editProductname" required><br/><br/>
                            <label>Category:</label>
                            <input type="text" readonly="true" name="editCategory" id="editCategory" required><br/><br/>
                            <label>Sub-Category:</label>
                            <input type="text" readonly="true" name="editSubCategory" id="editSubCategory" required><br/><br/>
                            <label>Rental Mode:</label>
                            <input type="text" name="editRentalMode" id="editRentalMode" required><br/><br/>
                            <label>Rental price:</label>
                            <input type="text" name="editRentalPrice" id="editRentalPrice" required><br/><br/>
                            <label>Status:</label>
                            <select id="editStatus" name="editStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select>
                            <div class="popupButtonDiv1"></div>
                                <button type="submit" class="searchButton marginTop10px" name="update">Update</button>
                                <button type="button" class="searchButton marginTop10px" onclick="closeEditForm()">Cancel</button> <br/><br/>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function editProduct(id, productname, category,subCategory,rentalMode,price,status) {
                        var selectedStatusIndex=1;
                       // alert(status);
                        if(status == 'Active')
                        {
                            selectedStatusIndex=0;
                        }
                        document.getElementById('editId').value = id;
                        document.getElementById('editProductname').value = productname;
                        document.getElementById('editCategory').value = category;
                        document.getElementById('editSubCategory').value = subCategory;
                        document.getElementById('editRentalMode').value = rentalMode;
                        document.getElementById('editRentalPrice').value = price;
                        document.getElementById('editStatus').selectedIndex = selectedStatusIndex;
                    // document.getElementById('editURL').value = url;
                        document.getElementById('editForm').style.display = 'block';
                        document.getElementById('editForm').style.display = 'flex';
                        
                    }

                    function closeEditForm() {
                       
                        document.getElementById('editForm').style.display = 'none';
                    }
                </script>
            </div>
      
        </div>
    </body>
</html>