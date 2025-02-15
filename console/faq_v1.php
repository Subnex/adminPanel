<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Management</title>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
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
            margin-top: 20px;
            border :2px solid red;
            width: 300px;
            margin-left:20px;
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
    </style>
</head>
<body>

    <h1>Manage FAQs</h1>

    <!-- Existing FAQs Section -->
    <div class="faq-container">
        <h2>All FAQs</h2>
        <div id="faq-list">
            <!-- FAQs will be loaded here dynamically -->
        </div>
    </div>

    <!-- Add New FAQ Section -->
    <div class="add-faq-form">
        <h2>Add a New FAQ</h2>
        <form id="faqForm">
            <label for="faqQuestion">Question:</label>
            <input type="text" id="faqQuestion" name="faqQuestion" placeholder="Enter the question" required>
            
            <label for="faqAnswer">Answer:</label>
            <div id="faqAnswerEditor" style="height: 200px; background: #fff;"></div>
            
            <input type="hidden" id="faqAnswer" name="faqAnswer">

            <button type="submit" class="submit-button">Add FAQ</button>
        </form>
    </div>

    <!-- Quill.js -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Initialize the rich-text editor
        const quill = new Quill('#faqAnswerEditor', {
            theme: 'snow',
            placeholder: 'Write the answer here...',
        });

        // Mock data for FAQs (this can be fetched from a server via AJAX)
        const faqs = [
            { question: "What is this app about?", answer: "This app helps you rent and lend items easily." },
            { question: "How do I list an item?", answer: "Simply go to the 'List Item' section and fill out the form." },
        ];

        // Load FAQs dynamically
        function loadFAQs() {
            const faqList = document.getElementById('faq-list');
            faqList.innerHTML = ''; // Clear any existing FAQs
            faqs.forEach((faq, index) => {
                const faqDiv = document.createElement('div');
                faqDiv.classList.add('faq-item');
                faqDiv.innerHTML = `
                    <h4>Q: ${faq.question}</h4>
                    <p>A: ${faq.answer}</p>
                `;
                faqList.appendChild(faqDiv);
            });
        }

        // Handle FAQ form submission
        document.getElementById('faqForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            // Get the question and answer from the form
            const question = document.getElementById('faqQuestion').value;
            const answer = quill.root.innerHTML; // Get HTML content from Quill editor
            
            // Add the new FAQ to the list
            faqs.push({ question, answer });
            
            // Clear the form
            document.getElementById('faqQuestion').value = '';
            quill.root.innerHTML = '';
            
            // Reload FAQs
            loadFAQs();
        });

        // Initial load of FAQs
        loadFAQs();
    </script>
</body>
</html>
