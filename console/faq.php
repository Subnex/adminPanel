
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
        session_set_cookie_params(0); 
       
        include('./header.php');
        require_once __DIR__ . '/Model/faqCls.php';
        $faqCls = new faqCls(false);
        $search = '';
        
          
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Save'])) {
             
            $id = $_POST['editId'];
            if($id == null)
            {
                $res = $faqCls->insertFAQ();
            }
            else
            {
                $res = $faqCls->UpdateFAQ();
            }
            $msg=$res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $result = $faqCls->getAllFAQ($search);
    
        }  
        
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $result = $faqCls->getAllFAQ($search);
    
        }
        else
        {
            $result = $faqCls->getAllFAQ($search);
        }

        
   ?>
</html>
<head>

<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/faq.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
</head>
<body>
        <div class="MainDiv">
          
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Search:
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="">
                    <button class="searchButton" type="submit" name="search-btn" >Search</button>
                    <!--<button class="searchButton" type="submit" name="search-flag-btn">Fetch All</button> -->    
                    <button  class="searchButton" name="addNew" onclick="addNewFAQ(null,null,null,0);return false;">Add New</button>
                </form>
            </div>
            <div class ="faqDetailSection">
                <table>
                    <thead>
                        <th width="100px">FAQ Code</th>
                        <th  width="200px">Question</th>
                        <th  width="500px">Answer</th> 
                        <th  width="50px">Status</th>
                        <th  width="50px">Action</th> 
                    </thead>
                    <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                            <td class="txtAlignCenter"><?php echo $row['faq_code']; ?></td>
                            <td><?php echo $row['question']; ?></td>
                            <td><?php 
                            
                            //echo $row['answer']; 

                            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
                            echo "<div>" . $row['answer'] . "</div>";
                            echo "</div>";
                            
                            ?></td>
                            <td class="txtAlignCenter"><?php if($row['status'] == 1){echo 'Active';}else {echo 'InActive';}  ?></td> 
                            <td class="txtAlignCenter">
                                <?php $escapedText = json_encode($row['answer']); ?>
                            <button onclick='addNewFAQ(<?php echo $row["id"]; ?>, "<?php echo $row["question"]; ?>",<?php echo $escapedText;?>,<?php echo addslashes($row["status"]); ?>);'><img src="img/edit.png" height="20px" width="20px" /></button>
                            </td>
                        </tr>
                        <?php endwhile; ?> 
                </table>
            </div>
            <div id="newForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                    <div id="popupHeader" class="popupHeader"><h3>Add/Edit New FAQ</h3></div>
                        <form id="faqForm" method="POST" action="" enctype="multipart/form-data">
                            <input type="hidden" name="editId" id="editId">
                            <input type="hidden" id="faqAnswer" name="faqAnswer"> 
                            <!--<label>FAQ Code:</label>
                            <input type="text" name="newFaqCode" id="newFaqCode" required><br/><br/> -->
                            <label>Question:</label>
                            <input type="text" class="popup_input" name="newQues" id="newQues" required><br/><br/>
                            <label>Answer:</label>
                            <!--<textarea class="textareaCls" name="newAns" required></textarea > -->
                            <div class="add-faq-form"> 
                                <div id="faqAnswerEditor" class="editorCustomCss" ></div>
                            </div>
                            
                            <br><br>
                           <!--<input type="textarea" name="newAns" id="newAns" required><br/><br/> -->
                            <label>Status:</label>
                            <select id="newStatus" name="newStatus" class="statusCss">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                            </select><br/>
                           
                            <div class="popupButtonDiv1">
                                <button class="searchButton"  type="submit" id="saveBtn" name="Save" onclick=" onSaveClick();">Save</button>
                               <!-- <button class="searchButton" type="submit" id="updateBtn" name="update" onclick="return onUpdateClick();" >Update</button> -->
                                <button  class="searchButton" type="button" onclick="closeNewForm()">Cancel</button>
                            </div>
                            <script>
                   
                                // Initialize the rich-text editor
                                const quill = new Quill('#faqAnswerEditor', {
                                    theme: 'snow',
                                    placeholder: 'Write the answer here...', 
                                });
                                var isUpdateAllowed = false;
                            
                                function addNewFAQ(id,ques, answer,status) 
                                {
                                    var selectedStatusIndex=0;
                                   // alert(ques);
                                    if(id != null)
                                    { 
                                       
                                        if(status == 0)
                                        {
                                            selectedStatusIndex=1;
                                        }
                                        //document.getElementById('popupHeader').innerHTML='Edit FAQ Details';
                                        document.getElementById('editId').value = id;
                                        document.getElementById('newQues').value = ques;
                                        document.getElementById('newStatus').selectedIndex = selectedStatusIndex;
                                        quill.root.innerHTML =answer; 
                                        isUpdateAllowed=true;
                                    }
                                   
                                    
                                    document.getElementById('newForm').style.display = 'block';
                                    document.getElementById('newForm').style.display = 'flex';
                                
                                    //setTimeout(addCustomCss, 1000);
                                    return false;
                                }

                                function closeNewForm() {
                                
                                    document.getElementById('newForm').style.display = 'none';
                                }
                                
                                function onSaveClick()
                                {
                                  
                                    const answer = quill.root.innerHTML; // Get HTML content from Quill editor
                                   // alert(answer);
                                    document.getElementById('faqAnswer').value=answer;
                                // alert( document.getElementById('replyMsg').value);
                                }
                            </script>
                        </form>
                    </div>
                </div>
                
            </div>
     
      
        </div>
    </body>
    
</html>