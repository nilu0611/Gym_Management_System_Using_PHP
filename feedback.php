<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "Nilesh@123";
    $dbname = "loginsystem";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, mobile, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $mobile, $message);

    // Execute the query and display thank you message
    if ($stmt->execute()) {
        echo '<!DOCTYPE html>
        <html>
        <head>
        <title>Feedback Submitted</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                flex-direction: column;
            }
            .thank-you-message {
                text-align: center;
                margin-bottom: 20px;
            }
            .back-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
            }
            .back-button:hover {
                background-color: #0056b3;
            }
        </style>
        </head>
        <body>
            <div class="thank-you-message">
                <h1>Thank you for your valuable feedback!</h1>
                <p>We will look into it.</p>
            </div>
            <a href="home.html" class="back-button">Go Back</a>
        </body>
        </html>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If form is not submitted, you might want to redirect to form page or show an error
    header('home.html'); // Replace 'your_form_page.php' with the actual page containing your form
    exit;
}
?>
