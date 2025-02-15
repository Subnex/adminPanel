
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
          session_set_cookie_params(0);
       
          include('./header.php');
          require_once __DIR__ . '/Model/UserMgntCls.php';
          require_once __DIR__ . '/Model/Member.php';
          $userMgnt = new UserMgntCls();
          $search = '';
        
         // $DB = new DataSource();
          //$conn = $DB->getAliveConnection();
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
             
              $res=$userMgnt->updateUserDetails();
              $result = $userMgnt->getUser($search);
              //print_r($res['message']);
              $msg=$res['message'];
              echo "<script type='text/javascript'>alert('$msg');</script>";
  
          }  
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Insert'])) {
           
                $res=$userMgnt->AddNewUser();
                $msg=$res['message'];
                //echo "=msg=".$msg;
                echo "<script type='text/javascript'>alert('$msg');</script>";
                $result = $userMgnt->getUser($search);
          }  
          if (isset($_GET['search'])) {
              $search = $_GET['search'];
              $result = $userMgnt->getUser($search);
      
          }
          else
          {
              $result = $userMgnt->getUser($search);
          }

   ?>
</html>
<head>
<link href="../console/asset/css/userMgnt.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
    
        <div class="MainDiv">
          
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Enter User Name :
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="User Name">
                    <button  class="searchButton" type="submit" name="search-btn" >Search</button>
                    <!--<button class="searchButton" type="submit" name="search-flag-btn">Fetch All</button> -->
                    <?php
                         if($_SESSION["superAdmin"] == true)
                         { ?>
                            <button  class="searchButton " name="addNew" onclick="AddNewUser();return false;">Add New</button>
                         
                         <?php
                         }
                          ?>
                   
                </form>
            </div>
            <div class="userDetailSection">
                <table>
                    <thead>
                        <th>User Code</th>
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Super Admin</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </thead>
                    <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                            <td><?php echo $row['admin_code']; ?></td>
                            <td><a target="_blank" href="../console/userdetail.php?uid=<?php echo $row['username']; ?>" ><?php echo $row['username']; ?></a></td>
                            <td><?php echo $row['email']; ?></td>
                            <td class="txtAlignCenter"><?php echo $row['mobile']; ?></td>
                            <td class="txtAlignCenter"><?php if($row['super_admin'] ==1){echo "True";}else{echo "False";} ?></td>
                            <td class="txtAlignCenter"><?php
                                $userStatus = 'Active';
                                if($row['status'] == '0')
                                {
                                    $userStatus = 'InActive';
                                }
                            echo  $userStatus; ?></td> 
                            <td class="txtAlignCenter">
                                <button onclick="editUser('<?php echo addslashes($row['id']); ?>', '<?php echo $row['username']; ?>', '<?php echo addslashes($row['email']); ?>',' <?php echo $row['status']; ?>',' <?php echo $row['mobile']; ?>')"><img src="img/edit.png" height="20px" width="20px" /></button>
                            </td>
                        </tr>
                        <?php endwhile; ?> 
                    
                </table>
            </div>
            <div id="editForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                        <div class="popupHeader"><h3>Edit Admin Details</h3></div>
                        <form method="POST" action="">
                            <input type="hidden" name="editId" id="editId">
                            <label>User Name:</label>
                            <input type="text" name="editUserName" id="editUserName" required><br/><br/>
                            <label>Email</label>
                            <input type="text" name="editEmail" id="editEmail" required><br/><br/>
                            <label>User Mobile:</label>
                            <input type="text" name="editUserMobile" id="editUserMobile" required><br/><br/>
                            <label>Status:</label>
                            <select id="editStatus" name="editStatus">
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
                    function editUser(recid,username, email, status,mobile) {
                        var selectedStatusIndex=0;
                        //alert(status);
                        if(status == 0)
                        {
                            selectedStatusIndex=1;
                        }
                        document.getElementById('editId').value = recid;
                        document.getElementById('editUserName').value = username;
                        document.getElementById('editEmail').value = email;
                        document.getElementById('editUserMobile').value = mobile;
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
                         <div class="popupHeader"><h3>Add Admin Details</h3></div>
                        <form method="POST" action="">
                            <input type="hidden" name="newId" id="newId">
                            <label>User Name:</label>
                            <input type="text" name="newUserName" id="newUserName" required><br/><br/>
                            <label>Email:</label>
                            <input type="text" name="newEmail" id="newEmail" required><br/><br/>
                            <label>Password:</label>
                            <input type="password" name="newPwd" id="newPwd" required><br/><br/>
                            <label>User Mobile:</label>
                            <input type="text" name="newUserMobile" id="newUserMobile" required><br/><br/>
                            <label>Super Admin:</label>
                            <input type="checkbox"  class="popupCheckBox" name="newUserType" id="newUserType" value="false">
                            <!--<input type="checkbox" class="popupCheckBox form-check-input" name="newUserType" id="newUserType" > --><br/><br/>
                            <label>Status:</label>
                            <!--<input type="text" name="newStatus" id="newStatus" required><br/><br/> -->
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
                    function AddNewUser() {

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