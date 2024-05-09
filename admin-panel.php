<!DOCTYPE html>
<?php

include('func.php');

$hostname = "localhost";
$username = "root";
$password = "Nilesh@123";
$databaseName = "loginsystem";




$connect = new mysqli($hostname, $username, $password, $databaseName);

$query = "SELECT * FROM `Trainer`";

$result1 = mysqli_query($connect, $query);







?>


<html>
<head>
    <title>Member Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style>
        .main-wrapper { padding: 20px; }
        .nav-login button { background-color: #007bff; color: white; }
        .jumbotron { border-radius: 0; background: url('images/3.jpg') no-repeat center center; background-size: cover; height: 400px; }
        .card-header { background-color: #007bff; color: #ffffff; }
        .btn-primary { background-color: #007bff;}
        .list-group-item.active { background-color: #007bff; border-color: #007bff; }
    </style>
</head>
<body>
    <div class="jumbotron"></div>
    <div class="container-fluid">
        <div class="row" >
            <div class="col-md-3">
                <div class="list-group">
                    <a href="" class="list-group-item active">Members</a>
  
                    <a href="members.php" class="list-group-item">Member details</a>
                    <a href="package.php" class="list-group-item">Package details</a>
                    <a href="payment.php" class="list-group-item">Payments</a>
                </div>
                <hr>
                <div class="list-group">
                    <a href="trainer_details.php" class="list-group-item active">Edit Trainer Details</a>
                    <a href="trainer.php" class="list-group-item active">Add new Trainer</a>
                    <a href="checkfeedback.php" class="list-group-item active">Check Feedback</a>

                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"d-flex justify-content-center align-items-center" style="height: 100px;">
                        <h3>Register New Members</h3>
                    </div>
                    <div class="card-body" >
                        <form class="form-group" action="func.php" method="post">
                            <label>First name:</label>
                            <input type="text" name="fname" class="form-control" required><br>
                            <label>Last name:</label>
                            <input type="text" name="lname" class="form-control" required><br>
                            <label>Email:</label>
                            <input type="text" name="email" class="form-control" required><br>
                            <label>Contact:</label>
                            <input type="text" name="contact" class="form-control" required><br>
                            <label>Trainer:</label>
                            <select class="form-control" name="trainer">
                                <?php while($row1 = mysqli_fetch_array($result1)):;?>
                                <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
                                <?php endwhile;?>
                            </select><br>
                            <input type="submit" class="btn btn-primary" name="mem_submit" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <nav>
            <div class="main-wrapper">
                <div class="nav-login">
                    <?php
                        if (isset($_SESSION['u_id'])) {
                            echo '<form action="includes/logout.php" method="POST">
                                    <button type="submit" name="submit">Logout</button>
                                  </form>';
                        } else {
                            echo '<a href="index.php" class="btn btn-primary">Logout</a>';
                        }
                    ?>
                </div>
            </div>
        </nav>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
