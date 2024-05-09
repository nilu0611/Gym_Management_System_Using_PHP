<!DOCTYPE html>
<?php include("func.php");?>
<html>
<head>
	<title>Member details</title>
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
             <div class="col-md-3"><h3>Members Details</h3></div>
             <div class="col-md-8">
         <form class="form-group" action="members.php" method="post">
          <div class="row">
   

              
                 </form></div></div></div>
     <div class="card-body" style="background-color:#3498DB;color:#ffffff;">
         <div class="card-body">
    <table class="table table-hover">
        <thead>
     <tr>
            <th>Member_ID</th>
            <th>First Name</th>
            <th>Last Name</th>
         <th>Email id</th>
         <th>Contact</th>
         <th>TrainerId</th>
        
         <th>Edit</th>
         <th>Delete</th>
        

        
        </tr>   
        </thead>
        <tbody>
          <?php get_members_details(); ?>
        </tbody>
    </table>
     </div>
    </div>
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