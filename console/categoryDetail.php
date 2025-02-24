
<?php
        session_start();
        $catCode='';
       // ini_set('display_errors', 1);
       // error_reporting(E_ALL);

        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }

        session_set_cookie_params(0);
        if (isset($_GET['catCode'])) {
            $catCode = $_GET['catCode'];
            //echo "catCode=: " . htmlspecialchars($catCode);
        }

          include('./header.php');
          require_once __DIR__ . '/Model/categoryDetailCls.php';
          $categoryCls = new categoryDetailCls();

          $search = '';
         // require '../console/vendor/autoload.php';
  
          use Aws\S3\S3Client;
          use Aws\Exception\AwsException;

        require_once __DIR__ . '/Model/config.php';
        //require_once __DIR__ . '../console/model/config.php';
       // echo "bucketname=";print_r($_ENV['AWS_BUCKETNAME']);
        $bucketName = $_ENV['AWS_BUCKETNAME'];//$s3BucketName;
        $region = $_ENV['AWS_REGION'];//$s3Region; // e.g., us-west-2
        $accessKey = $_ENV['AWS_ACCESS_KEY_ID'];// $s3AccessKey;
        $secretKey = $_ENV['AWS_SECRET_ACCESS_KEY'];//$s3SecretKey;
        $folderName = $_ENV['AWS_SUBCATEGORY'];//$s3SubCatFolderName;

       
        
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
                $key = 'AdminPanel/' . uniqid() . '-' . basename($file['editfile']);

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

   
             $res= $categoryCls->updateSubCategory($imgUrl);
            $msg=$res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $result = $categoryCls->getCategory($search);
            
          }  
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['InsertNewCat'])) 
          {
                if (isset($_FILES['newCatfile'])) 
                {
                   // echo "==pass from here==";
                    $s3Client = new S3Client([
                        'region'  => $region,
                        'version' => 'latest',
                        'credentials' => [
                            'key'    => $accessKey,
                            'secret' => $secretKey,
                        ],
                    ]);
                    //echo "S3Client created successfully!";
                   // echo "=start inserting1";  
                    $file = $_FILES['newCatfile'];
 
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!in_array($file['type'], $allowedTypes)) {
                        die("Error: Only JPEG, PNG, and GIF files are allowed.");
                    }
                    // Generate a unique name for the file
                    $key = $folderName . uniqid() . '-' . basename($file['newCatfile']);
                    //echo "pass from here";
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
            //echo "pass from here1";
            $imgUrl = $url;

            if($imgUrl != null)
             {   
                $catId = $_POST["catId"];
                $catCode = $_POST["catCode"];
             
                $res= $categoryCls->insertSubCategory($S3ConfigObj,$bucketName,$imgUrl,$catid,$catCode);
                $msg=$res['message'];
                echo "<script type='text/javascript'>alert('$msg');</script>";
                $search = $catCode;
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
            //header("Location: " . $_SERVER['PHP_SELF']);
            exit(); // Make sure to call exit after the header to stop the script
          }  
          
          if ($catCode != null) {
              $search = $catCode;
              $result = $categoryCls->getCategory($search);
              
              $subcategoryList = $categoryCls->getSubCategory($search);
              $totalRecords = count($result); 
          
          }
   ?>
</html>
<head>
    <style>
        .topBarSec
        {
            height: 135px;
            width: 100%;
            border-bottom: 1px solid #dedcdc;
            padding: 5px;
        }
        
    </style>

<link href="../console/asset/css/category.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
        <div class="MainDivSubCategory">
            <div class="SubCategoryDetailSection">
            <h4> Category Details:</h4> <a href="category.php" ><?php echo $result[0]["name"]?></a> 
                    <table>
                        <thead>
                                
                                <th>Category Code</th>
                                <th>Category Name</th>
                                <th>Category index</th>
                                <th>Category Icon</th>
                                <th>Category Status</th>
                            
                                
                        </thead>
                    <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                            <tr>
                                <td><a href="category.php" ><?php echo $row['category_code']; ?></a></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['category_index']; ?></td>
                                
                                <td>
                                    <img src="<?php echo $row['image_path']; ?>" height="50px" width="60px" />
                                </td>
                                <td><?php  if($row['status'] == 1){echo "Active";}else{echo "InActive";} ?></td>
                            
                        </tr>
                        <?php endwhile; ?>  
                    
                </table>
                <div><div class="SubCatHeaderLeft"> <h5>  Sub Category List</h5></div><div class="SubCatHeaderRight"> <button  type="submit" name="addbtn"   id="addbtn"   onclick="AddNewSubCategory('<?php echo addslashes($result[0]['id']); ?>', '<?php echo addslashes($result[0]['category_code']); ?>');return false;"> <img src="img/addNewItem.png" height="20px" width="20px" title="Add New Sub-Category" /></button><br/></div></div>
                <table>
                        <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Sub Category Name</th>
                                    <th>index</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                        </thead>
                        <?php 
                            $index =0; $totalRecords = count($subcategoryList);  while ($index < $totalRecords): $row = $subcategoryList[$index] ; $index++?>
                                <td><?php echo $row['sub_category_code']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['category_index']; ?></td>
                                
                                <td>
                                    <img src="<?php echo $row['image_path']; ?>" height="50px" width="50px" />
                                </td>
                                <td><?php  if($row['status'] == 1){echo "Active";}else{echo "InActive";} ?></td>
                                <td>
                                    <button onclick="editSubCategory('<?php echo addslashes($row['sub_category_code']); ?>', '<?php echo $row['name']; ?>', '<?php echo addslashes($row['status']); ?>', '<?php echo addslashes($row['category_index']); ?>')"><img src="img/edit.png" height="20px" width="20px" /></button>
                                </td>
                            </tr>
                            <?php endwhile; ?> 
                        
                    </table>
            </div>
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                <div class="popupHeader"><h3>Update Sub Category</h3></div>
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
                                <button class="searchButton" type="submit" name="update" >Update</button>
                                <button class="searchButton" type="button" onclick="closeEditForm();">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function editSubCategory(recid,name, status,index) {
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
                        <div class="popupHeader"><h3>Add New Category</h3></div>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="catId" id="catId">
                            <input type="hidden" name="catCode" id="catCode">
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
                                <button class="searchButton" type="submit" name="InsertNewCat" >Save</button>
                                <button class="searchButton" type="button" onclick="closeNewForm()">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <script>
                    function AddNewSubCategory(catid,catCode) {
                       // alert(catid);
                        document.getElementById('catId').value = catid;
                        document.getElementById('catCode').value = catCode;
                        document.getElementById('newForm').style.display = 'block';
                        document.getElementById('newForm').style.display = 'flex';
                        return false;
                    }

                    function closeNewForm() {
                       
                        document.getElementById('newForm').style.display = 'none';
                    }
                </script>
            </div>
        </div>
    </body>
</html>