<?php
// Enable error reporting for exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "Nilesh@123";
$dbname = "loginsystem";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Sanitize input
    $fname = $conn->real_escape_string($_POST['fname']);
    $lname = $conn->real_escape_string($_POST['lname']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO members (firstName, lastName, email, contactNumber) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $contact);

    // Execute the SQL statement
    $stmt->execute();

    // Get the ID of the newly inserted member
    $member_id = $conn->insert_id;

    // Redirect to payhere.php with member ID in URL
    header("Location: payhere.php?member_id=$member_id");
    exit();
} catch (mysqli_sql_exception $e) {
    $error = $e->getCode();
    if ($error == 1062) { // Error number for duplicate entry
        echo "<script>alert('Duplicate entry!');</script>";
        echo "<script>window.open('membership.php','_self')</script>";
    } else {
        echo "<script>alert('Error registering member. Error Code: " . $error . "');</script>";
        echo "<script>window.open('membership.php','_self')</script>";
    }
} finally {
    // Close statement and connection if they were initialized
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>
