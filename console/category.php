
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
          session_set_cookie_params(0);
       
          include('./header.php');
          require_once __DIR__ . '/Model/categoryCls.php';
          $categoryCls = new categoryCls();
          $search = '';
          //s3 configuration
         // require '../vendor/autoload.php'; 
  
          use Aws\S3\S3Client;
          use Aws\Exception\AwsException;

        require_once __DIR__ . '/Model/config.php';
        $bucketName = $_ENV['AWS_BUCKETNAME'];//$s3BucketName;
        $region = $_ENV['AWS_REGION'];//$s3Region; // e.g., us-west-2
        $accessKey = $_ENV['AWS_ACCESS_KEY_ID'];// $s3AccessKey;
        $secretKey = $_ENV['AWS_SECRET_ACCESS_KEY'];//$s3SecretKey;
        $folderName = $_ENV['AWS_CATEGORY'];//$s3SubCatFolderName;
        
         // $DB = new DataSource();
          //$conn = $DB->getAliveConnection();
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) 
          {
            if (isset($_FILES['editfile']) && $_FILES['editfile']['error'] == 0) 
            {
                $s3Client = new S3Client([
                    'region'  => $region,
                    'version' => 'latest',
                    'credentials' => [
                        'key'    => $accessKey,
                        'secret' => $secretKey,
                    ]
                ]);
                $file = $_FILES['editfile'];

                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($file['type'], $allowedTypes)) {
                    die("Error: Only JPEG, PNG, and GIF files are allowed.");
                }
                // Generate a unique name for the file
                $key = $folderName . uniqid() . '-' . basename($file['editfile']);

                // Upload the file to S3
                try{
                        $result = $s3Client->putObject([
                        'Bucket' => $bucketName,
                        'Key'    => $key,
                        'SourceFile' => $file['tmp_name'],
                        'ACL'    => 'public-read', // Make file publicly accessible
                    ]);
                    // File URL
                    $url = $result['ObjectURL']; 
                }
                catch(AwsException $e)
                {
                    echo "Error uploading file: " . $e->getMessage();
                }
            } else {
                echo "Error: " . $_FILES['newCatfile']['error'];
            }
            $imgUrl = $url;

            $res= $categoryCls->updateCategory($imgUrl);
            $msg=$res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $result = $categoryCls->getCategory($search);
               
               
            
    
          }  
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['InsertNewCat'])) {
                
                if (isset($_FILES['newCatfile'])) 
                {
                    $s3Client = new S3Client([
                        'region'  => $region,
                        'version' => 'latest',
                        'credentials' => [
                            'key'    => $accessKey,
                            'secret' => $secretKey,
                        ]
                    ]);
                    $file = $_FILES['newCatfile'];
 
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!in_array($file['type'], $allowedTypes)) {
                        die("Error: Only JPEG, PNG, and GIF files are allowed.");
                    }
                    // Generate a unique name for the file
                    $key = $folderName  . uniqid() . '-' . basename($file['newCatfile']);

                    // Upload the file to S3
                    try{
                            $result = $s3Client->putObject([
                            'Bucket' => $bucketName,
                            'Key'    => $key,
                            'SourceFile' => $file['tmp_name'],
                            'ACL'    => 'public-read', // Make file publicly accessible
                        ]);
                        // File URL
                        $url = $result['ObjectURL'];
                    }
                    catch(AwsException $e)
                    {
                        echo "Error uploading file: " . $e->getMessage();
                    }
            } else {
                echo "Error: " . $_FILES['newCatfile']['error'];
            }
            $imgUrl = $url;

            if($imgUrl != null)
             {   
                $res= $categoryCls->insertCategory($S3ConfigObj,$bucketName,$imgUrl);
                $msg=$res['message'];
                echo "<script type='text/javascript'>alert('$msg');</script>";
                $result = $categoryCls->getCategory($search);
            }
            else
            {
                $response = array(
                    "status" => "fail",
                    "message" => "S3 Uploading Error."
                );
                return $response;
            }
          }  
          if (isset($_GET['search'])) {
              $search = $_GET['search'];
              $result = $categoryCls->getCategory($search);
      
          }
          else
          {
              $result = $categoryCls->getCategory($search);
          }

   ?>
</html>
<head>
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/category.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/spinner.css" type="text/css" rel="stylesheet" /> 
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
        <div class="MainDiv">
          
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Search Category :
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Category Name">
                    <button  class="searchButton" type="submit" name="search-btn" >Search</button>
                    <button class="searchButton" type="submit" name="addbtn"   id="addbtn" value="Add New Category"  onclick="AddNewCategory();return false;"> Add New Category</button>
                    

                </form>
            </div>
            <div class="categoryDetailSection">
                <table>
                    <thead>
                            <tr>
                                <th>Category Code</th>
                                <th>Category Name</th>
                                <th>Category index</th>
                                <th>Category Icon</th>
                                <th>Category Status</th>
                                <th>Action</th>
                            </tr>
                    </thead>
                    <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                            <td><a href="categoryDetail.php?catCode=<?php echo  $row['category_code']; ?>" ><?php echo $row['category_code']; ?></a></td>
                            <td><?php echo $row['name']; ?></td>
                            <td class="txtAlignCenter"><?php echo $row['category_index']; ?></td>
                            
                            <td class="txtAlignCenter">
                                <img src="<?php echo $row['image_path']; ?>" height="50px" width="60px" />
                            </td>
                            <td class="txtAlignCenter"><?php  if($row['status'] == 1){echo "Active";}else{echo "InActive";} ?></td>
                            <td class="txtAlignCenter">
                                <button onclick="editCategory('<?php echo addslashes($row['id']); ?>', '<?php echo $row['name']; ?>', '<?php echo addslashes($row['status']); ?>', '<?php echo addslashes($row['category_index']); ?>')"><img src="img/edit.png" height="20px" width="20px" title="Edit Details" /></button>
                                <a href="categoryDetail.php?catCode=<?php echo $row['category_code']; ?>"><img src="img/subcategory.png" height="30px" width="30px" title="Manage Subcategory" /></a>
                            </td>
                        </tr>
                        <?php endwhile; ?> 
                    
                </table>
            </div>
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                        <h3>Edit Category Details</h3>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="editId" id="editId">
                            <label>Category Name:</label>
                            <input type="text" name="editCatName" id="editCatName" required><br/><br/>
                            <label>Category Index</label>
                            <input type="text" name="editIndex" id="editIndex" required><br/><br/>
                            <label>Status:</label>
                            <select id="editStatus" name="editStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select>
                            <label>Upload File:</label>
                            <input type="file" name="editfile" ><br/><br/>
                            <div class="popupButtonDiv">
                                <button class="searchButton" type="submit" name="update" onclick="showProcessingIcon()">Update</button>
                                <button class="searchButton" type="button" onclick="closeEditForm();">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function editCategory(recid,name, status,index) {
                        var selectedStatusIndex=0;
                        //alert(status);
                        if(status == 0)
                        {
                            selectedStatusIndex=1;
                        }
                        document.getElementById('editId').value = recid;
                        document.getElementById('editCatName').value = name;
                        document.getElementById('editIndex').value = index;
                        document.getElementById('editStatus').selectedIndex = selectedStatusIndex;
                        document.getElementById('editForm').style.display = 'block';
                        document.getElementById('editForm').style.display = 'flex';
                        
                    }

                    function closeEditForm() {
                       
                        document.getElementById('editForm').style.display = 'none';
                    }
                </script>
            </div>
            <div id="newForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                        <h3>Add New Category</h3>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="newId" id="newId">
                            <label>Category Name:</label>
                            <input type="text" name="newCatName" id="newCatName" required><br/><br/>
                            <label>Category Index:</label>
                            <input type="text" name="newCatIndex" id="newCatIndex" required><br/><br/>
                            <label>Status:</label>
                            <!--<input type="text" name="newStatus" id="newStatus" required><br/><br/> -->
                            <select id="newStatus" name="newStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select>
                            <label>Upload File:</label>
                            <input type="file" name="newCatfile" ><br/><br/>
                            <div class="popupButtonDiv">
                                <button class="searchButton" type="submit" name="InsertNewCat" onclick="showProcessingIcon()">Save</button>
                                <button class="searchButton" type="button" onclick="closeNewForm()">Cancel</button>
                            </div>
                            <img id="loadingSpinner" src="../console/img/spinner.gif" alt="Processing..."> 

                            <!-- The overlay (initially hidden) -->
                            <div id="overlay">
                                <img  id="loadingSpinner" src="../console/img/spinner.gif" alt="Processing...">
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function AddNewCategory() {

                        document.getElementById('newForm').style.display = 'block';
                        document.getElementById('newForm').style.display = 'flex';
                        return false;
                    }

                    function closeNewForm() {
                       
                        document.getElementById('newForm').style.display = 'none';
                    }

                    function showProcessingIcon() {
                        document.getElementById('newForm').style.display = 'none';
                        document.getElementById('overlay').style.display = 'flex'; // Show the overlay
                        document.getElementById('loadingSpinner').style.display = 'inline-block'; // Show the spinner
                        //document.body.classList.add('blurred');  // Apply blur effect to the page content

                        // Simulate a form submission or action (like an AJAX request or a form POST)
                        setTimeout(function() {
                            // This is where you'd make an AJAX call or trigger PHP processing
                            // For demonstration, we'll use a timeout to simulate processing
                            document.getElementById('processButton').innerHTML = 'Processing...';
                            
                            // Simulate form submission after a short delay (3 seconds)
                            document.forms[0].submit();  // You can uncomment this line to actually submit the form
                        }, 1000);  // Simulate a slight delay before submitting
                      
                    }
                </script>
            </div>
        </div>
       
       
    </body>
</html>