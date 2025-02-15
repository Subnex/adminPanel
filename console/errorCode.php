
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
          session_set_cookie_params(0);
       
          include('./header.php');
          require_once __DIR__ . '/Model/ErrorCodeCls.php';
          require_once __DIR__ . '/Model/Member.php';
          $errorCodeCls = new ErrorCodeCls();
          $search = '';
        
         // $DB = new DataSource();
          //$conn = $DB->getAliveConnection();
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
             
              $res=$errorCodeCls->UpdateErrorCode();
              $result = $errorCodeCls->getAllErrorCodes($search);
              //print_r($res['message']);
              $msg=$res['message'];
              echo "<script type='text/javascript'>alert('$msg');</script>";
  
          }  
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Insert'])) {
            try{
                    $res=$errorCodeCls->insertErrorCode();
                    $result = $errorCodeCls->getAllErrorCodes($search);
                    //print_r($res['message']);
                    $msg=$res['message'];
                    echo "<script type='text/javascript'>alert('$msg');</script>";
               
            
            } catch (PDOException $e) {
                // Display error message if there is a connection or query issue
                $message = "Error: " . $e->getMessage();
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
          }  
          if (isset($_GET['search'])) {
              $search = $_GET['search'];
              $result = $errorCodeCls->getAllErrorCodes($search);
      
          }
          else
          {
              $result = $errorCodeCls->getAllErrorCodes($search);
          }

   ?>
<html>
<head>
<link href="../console/asset/css/errorcode.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
    
        <div class="MainDiv">
          
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Search:
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="">
                    <button  class="searchButton" type="submit" name="search-btn" >Search</button>
                    <!--<button class="searchButton" type="submit" name="search-flag-btn">Fetch All</button> -->
                    <?php
                         if($_SESSION["superAdmin"] == true)
                         { ?>
                            <button  class="searchButton " name="addNew" onclick="AddNewError();return false;">Add New</button>
                         
                         <?php
                         }
                          ?>
                   
                </form>
            </div>
            <div class="errorCodeDetailSection">
                <table>
                    <thead>
                        <th>Error Code</th>
                        <th>Error Message</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </thead>
                    <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                        <tr>
                            <td><?php echo $row['error_code']; ?></td>
                            <td><?php echo $row['error_message']; ?></td>
                            <td><?php
                                $recStatus = 'Active';
                                if($row['status'] == '0')
                                {
                                    $recStatus = 'InActive';
                                }
                            echo  $recStatus; ?></td> 
                            <td>
                                <button onclick="editError('<?php echo addslashes($row['id']); ?>', '<?php echo $row['error_message']; ?>', '<?php echo addslashes($row['error_code']); ?>',' <?php echo $row['status']; ?>')"><img src="img/edit.png" height="20px" width="20px" /></button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    
                </table>
            </div>
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                    <div class="popup">
                    <div class="popupHeader"><h3>Edit Error Details</h3></div>
                        <form method="POST" action="">
                            <input type="hidden" name="editId" id="editId">
                            <label>Error Code:</label>
                            <input type="text" name="editCode" id="editCode" required><br/><br/>
                            <label>Error Message:</label>
                            <input type="text" name="editErrorText" id="editErrorText" required><br/><br/>
                            <label>Status:</label>
                            <select id="editStatusId" name="editStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select>
                            <div class="popupButtonDiv">
                                <button class="searchButton" type="submit" name="update" >Update</button>
                                <button class="searchButton" type="button" onclick="closeEditForm()">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
                <script>
                    function editError(id,errorCode, errorText, status) {
                       var selectedStatusIndex=0;
                        if(status != 'Active')
                        {
                            selectedStatusIndex=1;
                        }
                        document.getElementById('editId').value = id;
                        document.getElementById('editCode').value = errorCode;
                        document.getElementById('editErrorText').value = errorText;
                        document.getElementById('editStatusId').selectedIndex = selectedStatusIndex;
                        document.getElementById('editForm').style.display = 'block';
                        document.getElementById('editForm').style.display = 'flex';
                        
                    }

                    function closeEditForm() {
                       
                        document.getElementById('editForm').style.display = 'none';
                    }
                </script>
            </div>
            <div id="newErrorForm" style="display:none;" class="editFormDiv overlay">
                    <div class="popup">
                        <div class="popupHeader"><h3>Add Error Details</h3></div>
                        <form method="POST" action="">
                            <input type="hidden" name="newId" id="newId">
                            <label>Error Code:</label>
                            <input type="text" name="NewCode" id="NewCode" required><br/><br/>
                            <label>Error Message:</label>
                            <input type="text" name="Errormsg" id="errormsg" required><br/><br/>
                            <label>Status:</label>
                            <select id="newStatus" name="newStatus">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select>
                            <div class="popupButtonDiv">
                            <button class="searchButton" type="submit" name="Insert" >Save</button>
                            <button class="searchButton" type="button" onclick="closeNewForm()">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function AddNewError() {
                        document.getElementById('newErrorForm').style.display = 'block';
                        document.getElementById('newErrorForm').style.display = 'flex';
                        return false;
                    }

                    function closeNewForm() {
                       
                        document.getElementById('newErrorForm').style.display = 'none';
                    }
                </script>
            </div>
      
        </div>
    </body>
</html>