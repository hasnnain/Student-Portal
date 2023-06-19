<?php

@include 'connection/config.php';
@include 'connection/connect.php';	

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

					<h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

					<div class="row">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-4">
									<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Faculty</h5>
													</div>

													<?php
                        $i=0;
                        $sql="SELECT * FROM faculty order by id";
                        $query=mysqli_query($db,$sql);
                        if(!mysqli_num_rows($query) > 0 )
                              {
                                // echo '<td colspan="11"><center>No Course Registered</center></td>';
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
															<i class="align-middle" data-feather="home"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $i ?></h1>
												<div class="mb-0">
													<span class="text-muted">Total Number of Faculties</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
									<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Courses</h5>
													</div>

													<?php
                        $i=0;
                        $sql="SELECT * FROM courses order by id";
                        $query=mysqli_query($db,$sql);
                        if(!mysqli_num_rows($query) > 0 )
                              {
                                // echo '<td colspan="11"><center>No Course Registered</center></td>';
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
															<i class="align-middle" data-feather="book-open"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $i ?></h1>
												<div class="mb-0">
													<span class="text-muted">Total Number of Courses Registered</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Students</h5>
													</div>
													<?php
                        $i=0;
                        $sql="SELECT * FROM student order by id";
                        $query=mysqli_query($db,$sql);
                        if(!mysqli_num_rows($query) > 0 )
                              {
                                // echo '<td colspan="11"><center>No Course Registered</center></td>';
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
												<div class="mb-0">
													<span class="text-muted">Total Number of Students Registered</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>

					<div class="row">
					<div class="col-12 col-lg-8 col-xxl-9 d-flex">
						<div class="col-6 col-md-6 col-xxl-6 d-flex order-6 order-xxl-6">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div class="align-self-center w-100" id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div

				</div>
			</main>

			
		</div>
	</div>

	<script src="js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
  document.addEventListener("DOMContentLoaded", function() {
    var today = new Date();
    var defaultDate = today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
    document.getElementById("datetimepicker-dashboard").flatpickr({
      inline: true,
      prevArrow: "<span title=\"Previous month\">&laquo;</span>",
      nextArrow: "<span title=\"Next month\">&raquo;</span>",
      defaultDate: defaultDate,
      minDate: "today",
      maxDate: "today"
    });
  });
</script>

</body>

</html>