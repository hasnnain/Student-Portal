<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

session_start();

// Check if the 'admin' table exists and has records
$getEmailQuery = mysqli_query($con, "SELECT name FROM admin");
if (mysqli_num_rows($getEmailQuery) == 0) {
  exit("Can't Find Page");
}

if(isset($_POST['submit'])){
   $email =  $_POST['email'];
   $pass = $_POST['password'];

   // Prepare the query to prevent SQL injection
   $query = mysqli_prepare($con, "SELECT * FROM admin WHERE email = ? AND password = ?");
   mysqli_stmt_bind_param($query, "ss", $email, $pass);
   mysqli_stmt_execute($query);

   $result = mysqli_stmt_get_result($query);

   if(mysqli_num_rows($result) > 0){
         $row = mysqli_fetch_assoc($result);

         $_SESSION['name'] = $row['name'];
         header('location:index.php');
         exit();
   } else {
      $errorMessage = "Incorrect Password or Email";
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.php" />

	<title>Sign In | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Admin Login</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/avatars/avatar2.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form action="" method="POST">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" required />
											<small>
                                                Login as <a href="../student/login.php">Student</a>?
                                            </small>
										</div>
										<div class="text-center mt-3">
											<button type="submit" name="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
                  <?php if(isset($errorMessage)) { ?>
                    <div class="text-center mt-3">
                      <p class="text-danger"><?php echo $errorMessage; ?></p>
                    </div>
                  <?php } ?>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>
