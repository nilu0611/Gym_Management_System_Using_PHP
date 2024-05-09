<?php
include("func.php");

if(isset($_GET['memberId'])) {
    $memberId = $_GET['memberId'];
    
    // Delete member from the database
    $query = "DELETE FROM members WHERE memberId = $memberId";
    $result = mysqli_query($con, $query);
    
    if($result) {
        // Display alert and redirect back to the same page
        echo '<script>alert("Member deleted successfully."); window.location.href = "members.php";</script>';
    } else {
        // Display alert and redirect back to the same page
        echo '<script>alert("Error deleting member."); window.location.href = "members.php";</script>';
    }
} else {
    echo "MemberId parameter is missing.";
}
?>
