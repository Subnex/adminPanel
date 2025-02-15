
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
        session_set_cookie_params(0); 
        include('./header.php');
        
        require_once __DIR__ . '/Model/BannerCls.php';
        //require_once __DIR__ . '/Model/Member.php';
        //require_once __DIR__ . '/Model/S3Config.php';
        $bannerCls = new BannerCls();
       // $DB = new DataSource();
       // $conn = $DB->getConnection();
        $search = '';
        //s3 configuration
        //require '../vendor/autoload.php';
        use Aws\S3\S3Client;
        use Aws\Exception\AwsException;

        require_once __DIR__ . '/Model/config.php';
        $bucketName = $s3BucketName;
        $region = $s3Region; // e.g., us-west-2
        $accessKey = $s3AccessKey;
        $secretKey = $s3SecretKey;
        $folderName = $s3FolderName;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) 
        {
           // Initialize S3 client
            $s3Client = new S3Client([
                'region'  => $region,
                'version' => 'latest',
                'credentials' => [
                    'key'    => $accessKey,
                    'secret' => $secretKey,
                ]
            ]);
            $res = $bannerCls->UpdateBanner($s3Client,$bucketName);
            $msg=$res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>"; 
            $result = $bannerCls->getAllBanner($search);
    
        }  
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Save'])) {
             // Initialize S3 client
             $s3Client = new S3Client([
                'region'  => $region,
                'version' => 'latest',
                'credentials' => [
                    'key'    => $accessKey,
                    'secret' => $secretKey,
                ]
            ]);
            $res = $bannerCls->insertBanner($s3Client,$bucketName);
            $msg=$res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $result = $bannerCls->getAllBanner($search);
    
        }  
        
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $result = $bannerCls->getAllBanner($search);
    
        }
        else
        {
           
            $result = $bannerCls->getAllBanner($search);
        }

        
   ?>
</html>
<head>
<link href="../console/asset/css/banner.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
        <div class="MainDiv">
          
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Enter Banner Name :
                    <input type="text" name="search" class="SearchText" value="<?php echo htmlspecialchars($search); ?>" placeholder="">
                    <button class="searchButton" type="submit" name="search-btn" >Search</button>
                    <!--<button class="searchButton" type="submit" name="search-flag-btn">Fetch All</button> -->    
                    <button  class="searchButton" name="addNew" onclick="AddNewBanner();return false;">Add New</button>
                </form>
            </div>
            <div class ="bannerDetailSection">
                <table>
                    <thead>
                        <th style="width:2%">Banner Code</th>
                        <th>Banner Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </thead>
                    <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                            <td class="txtAlignCenter"><?php echo $row['banner_code']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                           
                            <td class="txtAlignCenter"><?php echo $row['start_date']; ?></td>
                            <td class="txtAlignCenter"><?php echo $row['end_date']; ?></td>
                            <td class="txtAlignCenter">
                                <img src="<?php echo $row['image_path']; ?>" height="50px" width="100px" />
                                
                            </td>
                            <td class="txtAlignCenter"><?php echo  $row['status']; ?></td> 
                            <td class="txtAlignCenter">
                            <button onclick="editProduct(<?php echo $row['id']; ?>, '<?php echo addslashes($row['title']); ?>', '<?php echo $row['status']; ?>','<?php echo addslashes($row['start_date']);?>','<?php echo addslashes($row['end_date']); ?>')"><img src="img/edit.png" height="20px" width="20px" /></button>
                            </td>
                        </tr>
                        <?php endwhile; ?> 
                </table>
            </div>
            <div id="newForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                    <div class="popupHeader"><h3>Add Banner Details</h3></div>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="newId" id="newId">
                            <label>Banner Code:</label>
                            <input type="text" name="newBannerCode" id="newBannerCode" required><br/><br/>
                            <label>Banner Name:</label>
                            <input type="text" name="newName" id="newName" required><br/><br/>
                            <label>Status:</label>
                            <select id="newStatus" name="newStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select><br/>
                            <label>Start Date:</label>
                            <input type="Date" name="newStartDate" id="newStartDate" required><br/><br/>
                            <label>End Date:</label>
                            <input type="Date" name="newEndDate" id="newEndDate" required><br/><br/>
                            <label>Upload File:</label>
                            <input type="file" name="Newfile" ><br/><br/>
                            <div class="popupButtonDiv1">
                                <button class="searchButton" type="submit" name="Save" >Save</button>
                                <button  class="searchButton" type="button" onclick="closeNewForm()">Cancel</button>
                                </div>
                        </form>
                    </div>
                </div>
                <script>
                    function AddNewBanner() {

                        document.getElementById('newForm').style.display = 'block';
                        document.getElementById('newForm').style.display = 'flex';
                        return false;
                    }

                    function closeNewForm() {
                       
                        document.getElementById('newForm').style.display = 'none';
                    }
                </script>
            </div>
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                <div class="popupHeader"><h3>Edit Banner Details</h3></div>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="editId" id="editId">
                            <label>Banner Code:</label>
                            <input type="text" name="editBannerCode" id="editBannerCode" required><br/><br/>
                            <label>Banner Name:</label>
                            <input type="text" name="editName" id="editName" required><br/><br/>
                            <label>Status:</label>
                            <select id="editStatusId" name="editStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select><br/>
                            <label>Start Date:</label>
                            <input type="Date" name="startDate" id="editStartDate" required><br/><br/>
                            <label>End Date:</label>
                            <input type="Date" name="endDate" id="editEndDate" required><br/><br/>
                            <label>Upload File:</label>
                            <input type="file" name="editfile" ><br/><br/>
                            <div class="popupButtonDiv1">
                                <button class="searchButton" type="submit" name="update" >Update</button>
                                <button class="searchButton" type="button" onclick="closeEditForm()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function editProduct(id, code,name, status,startDate,endDate) {
                       // alert(id);
                       var selectedStatusIndex=0;
                        if(status == '1')
                        {
                            selectedStatusIndex=1;
                        }
                        document.getElementById('editId').value = id;
                        document.getElementById('editBannerCode').value = code;
                        document.getElementById('editName').value = name;
                        document.getElementById('editStatusId').selectedIndex = selectedStatusIndex;
                        document.getElementById('editStartDate').value = startDate;
                        document.getElementById('editEndDate').value = endDate;
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