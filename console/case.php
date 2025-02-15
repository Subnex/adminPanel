<html>
    <body>
    <?php
       session_start();
       if (!isset($_SESSION["username"])){
          $url = "./Home.php";
          header("Location: $url");
        }
      session_set_cookie_params(0);
      include('./header.php');
      require_once __DIR__ . '/Model/caseCls.php';
      require_once __DIR__ . '/Model/emailServices.php';
      require_once __DIR__ . '/Model/Member.php';

      $caseCls = new caseCls();

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $res=$caseCls->updateCaseDetails();
        $msg=$res['message'];
        echo "<script type='text/javascript'>alert('$msg');</script>";
        $result = $caseCls->getCases($search);

    }     
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendReply'])) {
        $res = $caseCls->replyOnCase();
        $msg = $res['message'];
        echo "<script type='text/javascript'>alert('$msg');</script>";
        $result = $caseCls->getCases($search);
    }      
    
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = $caseCls->getCases($search);

    }
    else
    {
        $result = $caseCls->getCases($search);
    }
   ?>
    <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../console/asset/css/subnex_style.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/case.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
   <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .faq-container {
            margin-bottom: 20px;
        }
        .faq-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .faq-item h4 {
            margin: 0 0 5px;
        }
        .faq-item p {
            margin: 0;
        }
        .add-faq-form {
            margin-top: -9px;
            width: 85%;
            margin-left: 12.2%;
        }
        .add-faq-form textarea {
            width: 100%;
            height: 100px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .submit-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #218838;
        }
        .editorCustomCss{
            height: 300px; 
            background: #fff;
        }
    </style>
   </style>
    </head>
        <div class="MainDiv">
          
            <div class="topBar">
                <form method="GET" action="">
                    <div class="topBarInner"> Enter Case Id:
                    <input type="text" name="search" class="SearchText" value="<?php echo htmlspecialchars($search); ?>" placeholder="Case id">
                    <button class="searchButton" type="submit" name="search-btn" >Search</button>
                </form>
            </div>
            <div class ="caseDetailSection">
                <div class ="<?php  if(count($result) == 0){ echo 'displayNone';}?>">
                    <table>
                        <thead>
                            <tr>
                                <th>Case Number</th>
                                <th>Case Owner</th>
                                <th>Subject</th>
                                <th>Case Details</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <?php $index =0; $totalRecords = count($result);  while ($index < $totalRecords): $row = $result[$index] ; $index++?>
                        
                            <tr>
                                <td><?php echo $row['case_number']; ?></td>
                                <td><?php echo $row['case_owner_name']; ?></td>
                                <td><?php echo  $row['subject']; ?></td> 
                                <td><?php echo $row['message']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php
                                    $caseStatus = 'Closed';
                                    if($row['status'] == '0')
                                    {
                                        $caseStatus = 'Open';
                                    }
                                    echo  $caseStatus; ?>
                                </td> 
                                <td>
                                    <div class ="<?php  if($row['status'] == 1){ echo 'displayNone';}?>">
                                
                                    <button onclick="replyCase('<?php echo $row['case_number']; ?>', '<?php echo $row['subject']; ?>','<?php echo addslashes($row['message']);?>','<?php echo addslashes($row['email']); ?>')">
                                        <img src="img/reply.png" height="20px" width="20px" />
                                    </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
                <div class ="<?php  if(count($result) == 0){ echo 'displayBlock';}?>">
                    <!--<h4>No Open case found!</h4> -->
                </div>
            </div>
            
            <div id="replyForm" style="display:none;" class="editFormDiv overlay">
                <div class="popup">
                <div class=" mt-5">
                    <div class="popupHeader"><h3>Reply To Case</h3></div>
                
                    <!-- Reply Form --> 
                    <form  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="replyId" id="replyId">
                        <input type="hidden" name="replyEmail" id="replyEmail">
                        <input type="hidden" name="replySubject" id="replySubject">
                        <input type="hidden" id="replyMsg" name="replyMsg"> 
                        <div class="mb-4">
                            <table>
                                <tr>
                                    <td style="width:200px;"><label for="replyMessage" class="form-label">Case Number:</label></h4></td>
                                    <td><div id="displayCaseNumber"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="replyMessage" class="form-label">Subject:</label></td>
                                    <td><div id="displaySubject"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="replyMessage" class="form-label">Email:</label> </h4></td>
                                    <td><div id="displayEmail"></div></td>
                                </tr>
                                <tr>
                                    <td><label for="replyMessage" class="form-label">Message:</label></td>
                                    <td><div id="displayMsg"></div></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                    <div class="mb-3">
                                    <label for="replyMessage" class="form-label">Your Reply:</label>
                                            <div class="add-faq-form"> 

                                            
                                                <div id="replyMsgEditor" class="editorCustomCss" ></div>
                                            </div>
                                           
                                            
                                            <!--<textarea class="form-control" id="replyMsg" name="replyMsg" rows="5" required></textarea> -->
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="mb-3">
                                            <label for="attachment" class="form-label">Attach File:</label>
                                            <input type="file" class="form-control fileUpload" id="attachment" name="attachment">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                         <div class="popupButtonDiv1">
                                            <button class="searchButton" type="submit" name="sendReply" onclick="onEditorChange();">Reply</button>
                                            <button class="searchButton" type="button" onclick="closeReplyForm()">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                <script>
                     // Initialize the rich-text editor
                     const quill = new Quill('#replyMsgEditor', {
                        theme: 'snow',
                        placeholder: 'Type your content here...', 
                    });
                   
                    function replyCase(id, subject,msg,email) {
                       // alert(id);
                        document.getElementById('replyId').value = id;
                        document.getElementById('replyEmail').value = email;
                        document.getElementById('replySubject').value = subject;
                        document.getElementById('displayCaseNumber').innerHTML = id;
                        document.getElementById('displaySubject').innerHTML = subject;
                        document.getElementById('displayEmail').innerHTML = email;
                        document.getElementById('displayMsg').innerHTML = msg;
                    // document.getElementById('editURL').value = url;
                        document.getElementById('replyForm').style.display = 'block';
                        document.getElementById('replyForm').style.display = 'flex';
                        
                    }

                    function closeReplyForm() {
                       
                        document.getElementById('replyForm').style.display = 'none';
                    }
                    function onEditorChange()
                    {
                        const answer = quill.root.innerHTML; // Get HTML content from Quill editor
                        document.getElementById('replyMsg').value=answer;
                       // alert( document.getElementById('replyMsg').value);
                    }
                </script>
            </div>
      
        </div>
    </body>
    
</html>