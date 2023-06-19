<?php

@include 'connection/config.php';
@include 'connection/connect.php';	

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
// @include '../connection/connect.php';
if(!isset($_SESSION['name'])){
   header('location:login.php');
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

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

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

					<h1 class="h3 mb-3"><strong>Faculties</strong></h1>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Number of Faculties</h5>
													</div>

													<?php
                        $i=0;
                        $sql="SELECT * FROM faculty order by id";
                        $query=mysqli_query($db,$sql);
                        if(!mysqli_num_rows($query) > 0 )
                              {
                                echo '<td colspan="11"><center>No Faculty Registered</center></td>';
                              }else
                              {
                                while($row=mysqli_fetch_array($query))
                                {
                                    $i++;
                                }
                            }
                        ?>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $i ?></h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
					</div>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Faculty Details</h5>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
										    <th>Faculty</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
                        $i=0;
                        $sql="SELECT * FROM faculty order by name";
                        $query=mysqli_query($db,$sql);
                        if(!mysqli_num_rows($query) > 0 )
                              {
                                echo '<td colspan="11"><center>No Faculty Registered</center></td>';
                              }else
                              {
                                while($row=mysqli_fetch_array($query))
                                {
                                    $i++;
                              
                        ?>
										<tr>
											<td><?php echo $row['name'] ?></td>
											<td><a href="delete_faculty.php?delete_faculty=<?php echo $row['id'] ?>"><span class="badge bg-danger">Delete</span></a></td>
										</tr>
										<?php
              
            }
          }
              ?>
									</tbody>
								</table>
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