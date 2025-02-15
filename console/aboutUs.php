
<?php
        session_start();
        if (!isset($_SESSION["username"])){
            $url = "./Home.php";
            header("Location: $url");
          }
        session_set_cookie_params(0); 
       
        include('./header.php');
        require_once __DIR__ . '/Model/aboutUsCls.php';
        require_once __DIR__ . '/Model/Member.php';
         $aboutUsCls = new aboutUsCls();
        $search = '';
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Save'])) 
        {
            $res = $aboutUsCls->UpdateAboutUs();
            $msg=$res['message'];
            echo "<script type='text/javascript'>alert('$msg');</script>";
            $result = $aboutUsCls->getAboutUs($search);
    
        }  
        else
        {
            $result = $aboutUsCls->getAboutUs($search);
        }

        
   ?>
</html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../console/asset/css/aboutUs.css" type="text/css" rel="stylesheet" />
<link href="../console/asset/css/searchBar.css" type="text/css" rel="stylesheet" />
<script src="../console/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</head>
<body>
        <div class="MainDiv">
            <div class ="bannerDetailSection">
                <h3>About Us</h3><br/>
                <div class="toolbar">
                    <button onclick="formatText('bold')"><b>B</b></button>
                    <button onclick="formatText('italic')"><i>I</i></button>
                    <button onclick="formatText('underline')"><u>U</u></button>
                    <button onclick="formatText('insertUnorderedList')">• List</button>
                    <button onclick="formatText('insertOrderedList')">1. List</button>
                    <button onclick="addLink()">🔗 Link</button>
                </div>
                <!-- Editable Div for Rich-Text -->
                <div id="editor" class="editor" contenteditable="true">
                   <?php echo $result[0]['description'] ?>
                </div>

                <!-- Hidden Textarea to Store Content -->
                <form action="" method="POST" onsubmit="saveContent()">
                    <textarea id="content" name="content" style="display: none;"></textarea><br/>
                    <button class="searchButton" type="submit" name="Save" >Save</button>
                </form>
                <script>
                    // Function to apply formatting
                    function formatText(command) {
                        document.execCommand(command, false, null);
                    }

                    // Function to insert a hyperlink
                    function addLink() {
                        const url = prompt("Enter the URL:", "http://");
                        if (url) {
                            document.execCommand('createLink', false, url);
                        }
                    }

                    // Save the content from the editor into the hidden textarea
                    function saveContent() {
                        const editorContent = document.getElementById('editor').innerHTML;
                        document.getElementById('content').value = editorContent;
                    }
                </script>
            </div>
        </div>
    </body>
</html>
