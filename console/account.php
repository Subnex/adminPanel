
<?php
       session_start();
       if (!isset($_SESSION["username"])){
          $url = "./Home.php";
          header("Location: $url");
        }
      session_set_cookie_params(0); 
      
      include('./header.php');
      require_once __DIR__ . '/Model/accountCls.php';
      //require '../vendor/autoload.php';
      $accCls = new accountCls();
     
 //test
    //update 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) 
    {
       
        $res = $accCls->updateAccountDetails();

        $msg=$res['message'];
        echo "<script type='text/javascript'>alert('$msg');</script>";
        $result = $accCls->getAllAccount($search);

    }  

    $search = '';
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = $accCls->getAllAccount($search);

    }
    else
    {
       
        $search = $_GET['search'];
        $result = $accCls->getAllAccount($search);
        //print_r(count($result));
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search-flag-btn'])) {

        $result = $accCls->getFlaggedAccount();
    }

  
   
     
     
   ?>
</html>
<head>
<link href="../console/asset/css/account.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
 

        <div class="MainDiv">
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Search: 
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="">
                    <button class="searchButton"  type="submit" name="search-btn" >Search</button>
                    <button class="searchButton"  type="submit" name="search-flag-btn">Flagged Account</button> </div>

                </form>
            </div>
        
       
        <div class ="accDetailSection">
            <div id="accoundDetailsHeader">
                <div class="col1">Account ID</div>
                <div class="col2">User Name</div>
                <div class="col1">Mobile No.</div>
                <div class="col1">Date Of Birth</div>
                <div class="col1">Profile Img</div> 
                <div class="col1">Status</div>
                <div class="col3">Action</div>
            </div>
            <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                <div id="accoundDetailsData">
                    <div class="txtAlignCenter colData1"><?php echo $row['user_publisher_id']; ?></div>
                    <div class=" colData2"><?php echo $row['username']; ?></div>
                    <div class="txtAlignCenter colData1"><?php echo $row['mobile']; ?></div>
                    <div class="txtAlignCenter colData1"><?php echo date("d-M-Y", strtotime($row['date_of_birth'])); ?></div>
                    <div class="txtAlignCenter colData1"><img src="<?php echo $row['profile_image']; ?>" height="23px" width="40px" /></div>
                    <div class="txtAlignCenter colData1"><?php  if($row['status'] == 1){echo "Active";}else{echo "InActive";} ?></div>
                    <div class="txtAlignCenter colData3">
                        <button onclick="editAccount('<?php echo $row['user_publisher_id']; ?>', '<?php echo addslashes($row['username']); ?>','<?php echo addslashes($row['date_of_birth']);?>','<?php echo addslashes($row['status']); ?>')"><img src="img/edit.png" height="18px" width="18px" /></button>
                    </div>
                </div>  
            <?php endwhile; ?> 
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                    <div class="popupHeader"><h3>Edit Account Details</h3></div>
                    <form method="POST" action="">
                        <input type="hidden" name="editId" id="editId">
                        <label>User Name:</label>
                        <input type="text" name="editUserName" id="editUserName" required><br/><br/>
                        <label>Date Of Borth:</label>
                        <input type="Date" name="editDOB" id="editDOB" required><br/><br/>
                        <label>Status:</label>
                        <select id="editStatus" name="editStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                        </select>
                        <div class="popupButtonDiv">
                            <button class="searchButton marginTop10px"  type="submit" name="update">Update</button>
                            <button class="searchButton marginTop10px  "  type="button" onclick="closeEditForm()">Cancel</button><br/>
                        </div>
                    </form>
                </div>
        </div>
        <script>
                function editAccount(id, userName,dob, status) {
                var selectedStatusIndex=0;
                    //alert(id);
                    if(status == 0)
                    {
                        selectedStatusIndex=1;
                    }
                    document.getElementById('editId').value = id;
                    document.getElementById('editUserName').value = userName;
                    document.getElementById('editStatus').selectedIndex = selectedStatusIndex;
                    document.getElementById('editDOB').value = dob;
                    document.getElementById('editForm').style.display = 'block';
                    document.getElementById('editForm').style.display = 'flex';
                }

                function closeEditForm() {
                    document.getElementById('editForm').style.display = 'none';
                }
        </script>
    </div>
    </body>
</html>