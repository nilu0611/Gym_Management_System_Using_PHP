<?php
session_start();

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Nilesh@123';
$dbName = 'loginsystem';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM logintb WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && $password == $user['password']) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("Location: admin-panel.php");
        exit;
    } else {
        $_SESSION["error"] = "Invalid credentials";
        header("Location: index.php");
        exit();
    }
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
</head>
<style>
    #inputbtn:hover{cursor:pointer;}
</style>
<body style="background:url('images/4.jpg'); background-size: cover;">
    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="card">
                    <img src="images/cardback.jpg" class="card-img-top">
                    <div class="card-body">
                        <center>
                        <h5>Admin Login</h5><br>
                        <form class="form-group" method="POST" action=" ">
                            <div class="row">
                                <div class="col-md-4"><label>Username: </label></div>
                                <div class="col-md-8"><input type="text" name="username" class="form-control" required></div><br><br>
                                <div class="col-md-4"><label>Password: </label></div>
                                <div class="col-md-8"><input type="password" class="form-control" name="password" required></div><br><br><br>
                            </div>
                            <center><input type="submit" id="inputbtn" name="login_submit" value="Login" class="btn btn-primary"></center>
                        </form>
                        <?php if (isset($_SESSION["error"])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?>
                            </div>
                        <?php endif; ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-7"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>
