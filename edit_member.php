<!DOCTYPE html>
<?php
include("func.php");

if (isset($_POST['update_member'])) {
    $memberId = $_POST['memberId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $trainerid = $_POST['trainerid'];

    $email_check_stmt = $con->prepare("SELECT * FROM members WHERE email = ? AND memberId != ?");
    $email_check_stmt->bind_param("si", $email, $memberId);
    $email_check_stmt->execute();
    $email_check_result = $email_check_stmt->get_result();
    $email_check_stmt->close();

    // Check if trainer exists
    $trainer_stmt = $con->prepare("SELECT * FROM trainer WHERE Trainer_id = ?");
    $trainer_stmt->bind_param("i", $trainerid);
    $trainer_stmt->execute();
    $trainer_result = $trainer_stmt->get_result();

    if ($trainer_result->num_rows == 1) {
        // Trainer exists, proceed with update
        if ($email_check_result->num_rows == 0) {
            // The email is unique or the same as the current member's, proceed with the update
            $update_stmt = $con->prepare("UPDATE members SET firstName=?, lastName=?, email=?, contactNumber=?, trainerid=? WHERE memberId=?");
            $update_stmt->bind_param("sssssi", $fname, $lname, $email, $contact, $trainerid, $memberId);


            if ($update_stmt->execute()) {
                echo '<script>alert("Member updated successfully."); window.location.href = "members.php";</script>';
            } else {
                // If execute() is not successful
                if ($con->errno === 1062) {
                    echo '<script>alert("Duplicate key is there please enter another."); window.location.href = "edit_member.php?memberId=' . $memberId . '";</script>';
                } else {
                    // For other errors
                    echo '<script>alert("Error updating member."); window.location.href = "edit_member.php?memberId=' . $memberId . '";</script>';
                }
            }
            $update_stmt->close();
            // ...[rest of the code for execute update]
        } else {
            // Email is not unique, alert the user
            echo '<script>alert("The email address is already in use by another member. Please use a different email address."); window.location.href = "edit_member.php?memberId=' . $memberId . '";</script>';
        }
        
        
    } else {
        // Trainer does not exist, do not update and alert the user
        echo '<script>alert("Trainer ID does not exist, please reenter."); window.location.href = "edit_member.php?memberId=' . $memberId . '";</script>';
    }
    $trainer_stmt->close();
} 
?>



<html>
<head>
    <title>Edit Member Details</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .member-form label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
        }
        .member-form input[type='text'],
        .member-form input[type='email'],
        .member-form input[type='tel'] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Added for proper width calculation */
        }
        .member-form input[type='submit'] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 12px 25px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            font-weight: 600;
        }
        .member-form input[type='submit']:hover {
            background-color: #2980b9;
        }
        /* Additional styling for validation messages */
        .member-form input:invalid {
            border-color: #e74c3c;
        }
        .member-form input:invalid:focus {
            outline: none;
            box-shadow: 0 0 5px #e74c3c;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if(isset($_GET['memberId'])) {
        $memberId = $_GET['memberId'];

        // Fetch member details from the database
        $query = "SELECT * FROM members WHERE memberId = $memberId";
        $result = mysqli_query($con, $query);

        // Fetch all trainers from the database for the dropdown
        $trainerQuery = "SELECT Trainer_id, Name FROM trainer";
        $trainersResult = mysqli_query($con, $trainerQuery);
        $trainers = [];
        while ($trainerRow = mysqli_fetch_assoc($trainersResult)) {
            $trainers[] = $trainerRow;
        }

        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $fname = $row['firstName'];
            $lname = $row['lastName'];
            $email = $row['email'];
            $contact = $row['contactNumber'];
            $trainerid = $row['trainerid'];

            echo "<form action='' method='post' class='member-form'>
                      <input type='hidden' name='memberId' value='$memberId'>
                      <label for='fname'>First Name:</label>
                      <input type='text' name='fname' id='fname' value='$fname' required><br>
                      <label for='lname'>Last Name:</label>
                      <input type='text' name='lname' id='lname' value='$lname' required><br>
                      <label for='email'>Email:</label>
                      <input type='text' name='email' id='email' value='$email' required><br>
                      <label for='contact'>Contact:</label>
                      <input type='text' name='contact' id='contact' value='$contact' pattern='[0-9]+' title='Please enter numeric values only' required><br>
                      <label for='trainerid'>Trainer:</label>
                      <select name='trainerid' id='trainerid' required>
                          <option value=''>Select a trainer</option>";
            foreach ($trainers as $trainer) {
                echo "<option value='" . $trainer['Trainer_id'] . "'" . ($trainerid == $trainer['Trainer_id'] ? 'selected' : '') . ">" . htmlspecialchars($trainer['Name']) . "</option>";
            }
            echo "</select><br>
                      <input type='submit' name='update_member' value='Update'>
                  </form>";
        } else {
            echo "<script>alert('Member not found.');</script>";
        }
    } else {
        echo "<script>alert('MemberId parameter is missing.');</script>";
    }
    ?>
</div>
</body>
</html>
