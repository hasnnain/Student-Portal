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

   // Fetch student from the database
$studentQuery = "SELECT * FROM student where name = '".$_SESSION['name']."'";
$studentResult = mysqli_query($db, $studentQuery);
$student = mysqli_fetch_assoc($studentResult);
	

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
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="home"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $student['faculty']; ?></h1>
												<div class="mb-0">
													<span class="text-muted">Your Faculty</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
									<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Semester</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $student['semester']; ?></h1>
												<div class="mb-0">
													<span class="text-muted">Your Semester</span>
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
$i = 0;
$sql = "SELECT * FROM registered where st_name = '" . $_SESSION['name'] . "' order by id";
$query = mysqli_query($db, $sql);
if (!mysqli_num_rows($query) > 0) {
    // echo '<td colspan="11"><center>No Course Registered</center></td>';
} else {
    while ($row = mysqli_fetch_array($query)) {
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
												<h1 class="mt-1 mb-3"><?php echo $i; ?></h1>
												<div class="mb-0">
													<span class="text-muted">Total Number of Courses You Registered</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>

					<div class="row">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Presents</h5>
													</div>
													<?php
$i = 0;
$sql = "SELECT * FROM attendance where student_id = '" . $student['student_id'] . "' && status = '1' order by id";
$query = mysqli_query($db, $sql);
if (!mysqli_num_rows($query) > 0) {
    // echo '<td colspan="11"><center>No Course Registered</center></td>';
} else {
    while ($row = mysqli_fetch_array($query)) {
        $i++;
    }
}
?>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user-check"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $i; ?></h1>
												<div class="mb-0">
													<span class="text-muted">Total Number of Your Presents</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Absents</h5>
													</div>
													<?php
$i = 0;
$sql = "SELECT * FROM attendance where student_id = '" . $student['student_id'] . "' && status = '2' order by id";
$query = mysqli_query($db, $sql);
if (!mysqli_num_rows($query) > 0) {
    // echo '<td colspan="11"><center>No Course Registered</center></td>';
} else {
    while ($row = mysqli_fetch_array($query)) {
        $i++;
    }
}
?>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user-x"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?php echo $i; ?></h1>
												<div class="mb-0">
													<span class="text-muted">Total Number of Your Absents</span>
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
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

</body>

</html>