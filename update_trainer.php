<?php
include("func.php");

if(isset($_POST['update_trainer'])) {
    $trainerId = $_POST['trainerId'];
    $fname = $_POST['fname'];
    $phone = $_POST['phone']; // Corrected to 'phone' as per the HTML form
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    // Update trainer details in the database
    $query = "UPDATE Trainer SET Name = '$fname', phone = '$phone', email = '$email' ,address='$address' WHERE Trainer_id = $trainerId";
    $result = mysqli_query($con, $query);
    
    if($result) {
        echo "<script>alert('Trainer details updated successfully.');</script>";
        echo "<script>window.open('trainer_details.php','_self')</script>";
    } else {
        echo "<script>alert('Error updating trainer details.');</script>";
        echo "<script>window.open('trainer_details.php','_self')</script>";
    }
} else {
    echo "Invalid request.";
}
?>
