<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ./Home.php");
    exit();
}

include('./header.php');
require_once __DIR__ . '/Model/faqCls.php';

$faqCls = new faqCls(false);
$search = '';
$result = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Save'])) {
    $id = $_POST['editId'] ?? null;
    $res = ($id === null) ? $faqCls->insertFAQ() : $faqCls->UpdateFAQ();
    echo "<script type='text/javascript'>alert('{$res['message']}');</script>";
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$result = $faqCls->getAllFAQ($search);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Management</title>
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
                <div class="topBarInner">
                    Search:
                    <input type="text" class="SearchText" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="">
                    <button class="searchButton" type="submit" name="search-btn">Search</button>
                    <button class="searchButton" name="addNew" onclick="addNewFAQ(null, null, null, 0); return false;">Add New</button>
                </div>
            </form>
        </div>

        <div class="faqDetailSection">
            <table>
                <thead>
                    <tr>
                       
                        <th width="200px">Question</th>
                        <th width="500px">Answer</th> 
                        <th width="50px">Status</th>
                        <th width="50px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr>
                           
                            <td><?php echo htmlspecialchars($row['question']); ?></td>
                            <td>
                                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                                    <div><?php echo $row['answer']; ?></div>
                                </div>
                            </td>
                            <td class="txtAlignCenter"><?php echo $row['status'] == 1 ? 'Active' : 'InActive'; ?></td> 
                            <td class="txtAlignCenter">
                                <?php $escapedText = json_encode($row['answer'], JSON_HEX_TAG); ?>
                                <button onclick='addNewFAQ(<?php echo $row["id"]; ?>, "<?php echo $row["question"]; ?>", <?php echo $escapedText; ?>, <?php echo addslashes($row["status"]); ?>);'>
                                    <img src="img/edit.png" height="20px" width="20px" />
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </div>

        <div id="newForm" style="display:none;" class="editFormDiv overlay">
            <div class="popup">
                <div id="popupHeader" class="popupHeader">
                    <h3>Add/Edit New FAQ</h3>
                </div>
                <form id="faqForm" method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="editId" id="editId">
                    <input type="hidden" id="faqAnswer" name="faqAnswer">
                    <label>Question:</label>
                    <input type="text" class="popup_input" name="newQues" id="newQues" required><br/><br/>
                    <label>Answer:</label>
                    <div class="add-faq-form">
                        <div id="faqAnswerEditor" class="editorCustomCss"></div>
                    </div>
                    <br><br>
                    <label>Status:</label>
                    <select id="newStatus" name="newStatus" class="statusCss">
                        <option value="Active">Active</option>
                        <option value="InActive">InActive</option>
                    </select><br/>
                    <div class="popupButtonDiv1">
                        <button class="searchButton" type="submit" id="saveBtn" name="Save">Save</button>
                        <button class="searchButton" type="button" onclick="closeNewForm()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const quill = new Quill('#faqAnswerEditor', {
            theme: 'snow',
            placeholder: 'Write the answer here...',
        });

        function addNewFAQ(id, ques, answer, status) {
            let selectedStatusIndex = status === 0 ? 1 : 0;
            document.getElementById('editId').value = id ?? '';
            document.getElementById('newQues').value = ques ?? '';
            document.getElementById('newStatus').selectedIndex = selectedStatusIndex;
            quill.root.innerHTML = answer ?? '';
            document.getElementById('newForm').style.display = 'flex';
        }

        function closeNewForm() {
            document.getElementById('newForm').style.display = 'none';
        }

        document.getElementById('faqForm').addEventListener('submit', function() {
            const answer = quill.root.innerHTML;
            document.getElementById('faqAnswer').value = answer;
        });
    </script>
</body>
</html>
