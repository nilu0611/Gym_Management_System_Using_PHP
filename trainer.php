<!DOCTYPE html>
<?php include("func.php");?>
<html>
<head>
    <title>Trainer details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <style>
        .jumbotron {
            background: url('images/2.jpg') no-repeat;
            background-size: cover;
            height: 300px;
        }

        .container {
            margin-top: 20px;
        }

        .card-body {
            background-color: #3498DB;
            color: #ffffff;
        }

        .btn-light {
            background-color: #ffffff;
            color: #000000;
        }

        h3 {
            color: #ffffff;
            justify-content: left;
            text-align: left; /* Align heading text to left */
        }

        form {
            margin-bottom: 20px;
        }

        label {
            color: #ffffff;
        }

        .register-heading {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="jumbotron"></div>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <a href="admin-panel.php" class="btn btn-light">Go Back</a>
                </div>
                <div class="col-md-3">
                    <h3>Trainer</h3>
                </div>
                <div class="col-md-8">
                    <form class="form-group" action="patient_search.php" method="post">
                        <div class="row"></div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <h3 class="register-heading">Register new Trainer</h3> <!-- Added class for styling -->
            </div>
            <form class="form-group" action="func.php" method="post">
                <label>Trainer ID</label>
                <input type="text" name="Trainer_id" class="form-control" required><br>
                <label>Name</label>
                <input type="text" name="Name" class="form-control" required><br>
                <label>Email</label>
                <input type="email" name="email" class="form-control" required><br>
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required><br>
                <label>Address</label>
                <input type="text" name="address" class="form-control" required><br>
                <input type="submit" class="btn btn-primary" name="tra_submit" value="Register">
            </form>
        </div>
    </div>
</div>
<footer>
    <nav>
        <div class="main-wrapper d-flex justify-content-center align-items-center" style="height: 100px;">
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
