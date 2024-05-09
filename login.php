<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/2.jpg');  /* Replace 'images/2.jpg' with your actual image path */
            background-size: cover; /* Cover the entire page */
            background-position: center; /* Center the image */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #000; /* Changed to black */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 320px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff; /* Changed label color to white */
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: #333; /* Dark input backgrounds */
            color: #fff; /* Light text color for readability */
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            box-sizing: border-box;
        }

        .login-button {
            background-color: orangered;
            color: white;
        }

        .register-button {
            background-color: orangered;
            color: white;
        }

        input[type="submit"]:hover {
            opacity: 0.8;
        }

        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $contact = $_POST['contact'];

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

            // Sanitize input
            $contact = $conn->real_escape_string($contact);

            // Prepare the SQL statement
            $stmt = $conn->prepare("SELECT * FROM members WHERE contactNumber = ?");
            $stmt->bind_param("s", $contact);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Phone number exists in the members table
                $row = $result->fetch_assoc();
                $member_id = $row['memberId']; // Correct the case to match the column name in the database
                // Assuming 'id' is the column name for the member ID in the database

                // Redirect to payhere.php with member ID in URL
                header("Location: payhere.php?member_id=$member_id");
                exit();
            } else {
                // Phone number doesn't exist in the members table
                echo "<p class='error'>Phone number not found. Please register.</p>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="contact">Mobile Number:</label>
            <input type="text" id="contact" name="contact" required>
            <input type="submit" class="login-button" value="Login">
            
        </form>
        <br>
        <form action="membership.php" method="post">
            <input type="submit" class="register-button" value="Register">
           
        </form>
    </div>
</body>
</html>
