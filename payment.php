<?php

function generate_payment_id() {
    $length = 6; // Define the length of the payment ID
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Define the characters to use
    $payment_id = ''; // Initialize the payment ID variable

    // Generate a random payment ID
    for ($i = 0; $i < $length; $i++) {
        $payment_id .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $payment_id;
}

function get_packages() {
    global $con;
    $packages = array();

    $query = "SELECT * FROM Package";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $packages[] = $row;
        }
    }

    return $packages;
}

?>

<!DOCTYPE html>
<?php include("func.php");?>
<html>
<head>
    <title>Payment details</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<div class="jumbotron" style="background: url('images/2.jpg') no-repeat;background-size: cover;height: 300px;"></div>   

 <div class="container">
<div class="card">
     <div class="card-body" style="background-color:#3498DB;color:#ffffff;">
         <div class="row">
             <div class="col-md-1">
    <a href="admin-panel.php" class="btn btn-light ">Go Back</a>
             </div>
             <div class="col-md-3"><h3>Payment Details</h3></div>
             <div class="col-md-8">
         <form class="form-group" action="patient_search.php" method="post">
          <div class="row">
              
                 </form></div></div></div>
     <div class="card-body" style="background-color:#3498DB;color:#ffffff;">
         <div class="card-body">
    <table class="table table-hover">
        <thead>
     <tr>
            <th>Id</th>
            <th>Amount</th>
            <th>Payment Type</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Valid Till</th>
         
        </tr>   
        </thead>
        
        <tbody>
          <?php get_payment(); ?>
        </tbody>
    </table>
    <div class="card-body" style="background-color:#3498DB;color:FFFFFF;">
                <h3>Make new Payment</h3>
                </div> 
                <div class="card-body"></div>
                <form class="form-group" action="func.php" method="post">
                <label>Payment ID</label>
    <input type="text" name="Payment_id" value="<?php echo generate_payment_id(); ?>" class="form-control" readonly><br> 
                <label>Amount</label>
                    <select name="Amount" class="form-control" required>
                        <?php
                            // Fetch package details from the database
                            $packages = get_packages();
                            foreach ($packages as $package) {
                                echo "<option value='" . $package['Amount'] . "'>" . $package['Amount'] . "</option>";
                            }
                        ?>
                    </select><br>
                   
                    <label>Customer ID</label>
                    <input type="text" name="customer_id" class="form-control" required><br>
                    <label>Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" required><br>
                    <label>Payment Type</label>
<input type="text" name="payment_type" class="form-control" required><br>


<input type="submit" class="btn btn-primary" name="pay_submit" value="PAY">

</div> 
    
    <br>
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
    </div>
    </body>
</html>
