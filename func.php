<?php
error_reporting(E_ERROR | E_PARSE);

$con = new mysqli("localhost", "root", "Nilesh@123", "loginsystem");



if (isset($_POST['mem_submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $trainername = $_POST['trainer'];

    // Check if the email already exists in the database
    $email_check_query = "SELECT * FROM Members WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $email_check_query);
    $member = mysqli_fetch_assoc($result);

    if ($member) { // If email exists
        echo "<script>alert('Email already exists. Please re-enter the email.');</script>";
        echo "<script>window.open('admin-panel.php','_self')</script>";
    } else {
        // Proceed with member insertion
        $stmt = $con->prepare("INSERT INTO Members (firstName, lastName, email, contactNumber, trainerid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $lname, $email, $contact, $trainername);
        if ($stmt->execute()) {
            echo "<script>alert('Member registered successfully!');</script>";
            echo "<script>window.open('admin-panel.php','_self')</script>";
        } else {
            echo "<script>alert('Error registering member.');</script>";
        }
        $stmt->close();
    }
}

if (isset($_POST['tra_submit'])) {
    $Trainer_id = $_POST['Trainer_id'];
    $Name = $_POST['Name'];
    $phone = $_POST['phone'];
    $Email = $_POST['email']; // Fetch the email from the form
    $Address = $_POST['address']; // Fetch the address from the form

    try {
        $query = "insert into Trainer(Trainer_id, Name, phone, email, address) values ('$Trainer_id','$Name','$phone','$Email','$Address')";
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Trainer added.')</script>";
            echo "<script>window.open('trainer.php','_self')</script>";
        } else {
            throw new Exception(mysqli_error($con));
        }
    } catch (Exception $e) {
        echo "<script>alert('Error or Duplicate entry');</script>";
        echo "<script>window.open('trainer.php','_self')</script>";

    }
}

if (isset($_POST['pay_submit'])) {
    $Payment_id = $_POST['Payment_id'];
    $Amount = $_POST['Amount'];
    $customer_id = $_POST['customer_id'];
    $payment_type = $_POST['payment_type'];

    $customer_name = $_POST['customer_name'];

    // First, check if the customer_id exists in the members table
    $member_check_query = "SELECT * FROM members WHERE memberId = ?";
    $stmt = mysqli_prepare($con, $member_check_query);
    mysqli_stmt_bind_param($stmt, "i", $customer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // If the member exists, proceed with inserting the payment
    if (mysqli_num_rows($result) > 0) {
        $insert_payment_query = "INSERT INTO Payment(Payment_id, Amount, customer_id, payment_type, customer_name) VALUES (?, ?, ?, ?, ?)";
        $payment_stmt = mysqli_prepare($con, $insert_payment_query);
        mysqli_stmt_bind_param($payment_stmt, "ssdss", $Payment_id, $Amount, $customer_id, $payment_type, $customer_name);
         $execute_result = mysqli_stmt_execute($payment_stmt);
        if ($execute_result) {
            echo "<script>alert('Payment successful.')</script>";
            echo "<script>window.open('payment.php','_self')</script>";
        } else {
            echo "<script>alert('Error processing payment.');</script>";
            echo "<script>window.open('payment.php','_self')</script>";
        }
        mysqli_stmt_close($payment_stmt);
    } else {
        echo "<script>alert('Invalid member ID. Payment not processed.');</script>";
        echo "<script>window.open('payment.php','_self')</script>";
    }
    mysqli_stmt_close($stmt);
}


function get_members_details()
{
    global $con;
    $query = "select * from members";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $Member_id = $row['memberId'];
        $fname = $row['firstName'];
        $lname = $row['lastName'];
        $email = $row['email'];
        $contact = $row['contactNumber'];
        $trainid = $row['trainerid'];
        
        
        

        echo "<tr>
      <td>$Member_id</td>
          <td>$fname</td>
        <td>$lname</td>
            <td>$email</td>
            <td>$contact</td>
            <td>$trainid</td>
         
          <td><a href='edit_member.php?memberId=$Member_id' class='btn btn-primary'>Edit</a></td>
          <td><a href='delete_member.php?memberId=$Member_id' class='btn btn-danger'>Delete</a></td>

         
        </tr>";
    }
}

function get_package()
{
    global $con;
    $query = "select * from Package";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $Package_id = $row['Package_id'];
        $Package_name = $row['Package_name'];
        $Amount = $row['Amount'];
        echo "<tr>
        <td>$Package_id</td>
        <td>$Package_name</td>
            <td>$Amount</td>
            
        </tr>";
    }
}

function get_trainer()
{
    global $con;
    $query = "select * from Trainer";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $Trainer_id = $row['Trainer_id'];
        $Name = $row['Name'];
        $phone = $row['phone'];
        $Email = $row['email']; // Fetch the email from the database
        $Address = $row['address']; // Fetch the address from the database

        echo "<tr>
                <td>$Trainer_id</td>
                <td>$Name</td>
                <td>$phone</td>
                <td>$Email</td>
                <td>$Address</td>
                <td><a href='edit_trainer.php?trainerId=$Trainer_id' class='btn btn-primary'>Edit</a></td>
                <td><a href='delete_trainer.php?trainerId=$Trainer_id' class='btn btn-danger'>Delete</a></td>
            </tr>";
    }
}

function get_payment() {
    global $con;
    $query = "SELECT *, DATE_ADD(payment_timestamp, INTERVAL 30 DAY) AS valid_till FROM Payment ORDER BY customer_id";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $Payment_id = $row['Payment_id'];
        $Amount = $row['Amount'];
        $payment_type = $row['payment_type'];
        $customer_id = $row['customer_id'];
        $customer_name = $row['customer_name'];
        $valid_till = $row['valid_till'];

        echo "<tr>
            <td>$Payment_id</td>
            <td>$Amount</td>
            <td>$payment_type</td>
            <td>$customer_id</td>
            <td>$customer_name</td>
            <td>$valid_till</td>
        </tr>";
    }
}


?>
