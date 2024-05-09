<?php
include("func.php");

if(isset($_GET['trainerId'])) {
    $trainerId = $_GET['trainerId'];
    
    // Delete trainer from the database
    $query = "DELETE FROM Trainer WHERE Trainer_id = $trainerId";
    $result = mysqli_query($con, $query);
    
    if($result) {
        echo "<script>alert('Trainer deleted successfully.');</script>";
        echo "<script>window.location='trainer_details.php';</script>";
    } else {
        echo "<script>alert('Error deleting trainer.');</script>";
        echo "<script>window.location='trainer_details.php';</script>";
    }
} else {
    echo "<script>alert('TrainerId parameter is missing.');</script>";
    echo "<script>window.location='admin-panel.php';</script>";
}
?>
