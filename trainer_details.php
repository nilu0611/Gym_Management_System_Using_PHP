<!DOCTYPE html>
<?php include("func.php");?>
<html>
<head>
	<title>Trainer details</title>
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
					<div class="col-md-3">
						<h3>Trainer Details</h3>
					</div>
					<div class="col-md-8">
						<form class="form-group" action="trainer_search.php" method="post">
							<div class="row">
								<div class="col-md-9">
									
								</div>
								<div class="col-md-3">
									
								</div>
							</div>           
						</form>
					</div>
				</div>
			</div>
			<div class="card-body" style="background-color:#3498DB;color:#ffffff;">
				<div class="card-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Address</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>   
						</thead>
						<tbody>
							<?php get_trainer(); ?>
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
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
