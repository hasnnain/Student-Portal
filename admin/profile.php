<?php
  @include 'connection/config.php';
  @include 'connection/connect.php';	
 error_reporting(0);

 error_reporting(E_ALL);
ini_set('display_errors', 1);

 session_start();

 if(!isset($_SESSION['name'])){
	header('location:login.php');
 }

   // Fetch faculties from the database
$adminQuery = "SELECT * FROM admin where name = '".$_SESSION['name']."'";
$adminResult = mysqli_query($db, $adminQuery);
$admin = mysqli_fetch_assoc($adminResult);
	

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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.php" />

	<title>Profile | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
	    <?php include "includes/sidebar.php"; ?>

		<div class="main">
			<?php include "includes/nav.php"; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Profile</h1>
					</div>
					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
								<div class="card-header">
								</div>
								<div class="card-body text-center">
									<img src="adminImages/<?php echo $admin['photo']; ?>" alt="Your Image" class="img-fluid rounded-circle mb-2" width="128" height="128" />
									

									<div>
									   <!-- <h1 class="card-title mb-0"></h1> -->
									</div>
								</div>
								<hr class="my-0" />
							</div>
						</div>

						<div class="col-md-8 col-xl-9">
							<div class="card">
								<div class="card-header">
									
								</div>
								<div class="card-body h-100">
									<div class="d-flex align-items-start">
										<div class="flex-grow-1">
											<h4><strong>Name:</strong> <?php echo $_SESSION['name'] ?></h4><br />

										</div>
									</div>

									<hr />
									<div class="d-flex align-items-start">
										<div class="flex-grow-1">
											<h4><strong>Email:</strong> <?php echo $admin['email']; ?></h4><br />

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			
		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>