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
$facultyQuery = "SELECT * FROM faculty";
$facultyResult = mysqli_query($db, $facultyQuery);
$faculties = mysqli_fetch_all($facultyResult, MYSQLI_ASSOC);


   if(isset($_POST['submit']))
   {
		if($_POST['name']=='')
		{
			$error =   '<div class="alert alert-danger alert-dismissible fade show">
				           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>Enter Course Name!</strong>
						</div>';
		}else
		{
      
                $name = $_POST['name'];
                $name = strtoupper($name);
				$sql = "INSERT INTO courses(faculty,semester,name) VALUE('".$_POST['faculty']."','".$_POST['semester']."','".$name."')";

                $check = "SELECT name FROM courses where (name='$name');";

                $rescheck=mysqli_query($db,$check);
                if(mysqli_num_rows($rescheck) > 0)
                {
                  $row = mysqli_fetch_assoc($rescheck);
                  if($name==isset($row['name']))
                  {
                     $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <strong>This Course is Already Registered.</strong>
                               </div>';
                  }
                  
                }else
                {
                  $res = mysqli_query($db, $sql);
                 
                  $success = 	'<div class="alert alert-success alert-dismissible fade show mt-2">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          Course Registered Successfully.
                         </div>';
                }

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

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.php" />

	<title>Sign Up | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
	    <?php include 'includes/sidebar.php'; ?>

        <div class="main">
           <?php include"includes/nav.php"; ?>

	<main class="d-flex w-100">
        
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Add New Course</h1>
							<p><?php
                                if (isset($error)) {
                                    echo $error;
                                }
                                if (isset($success)) {
                                    echo $success;
                                }
                                ?></p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form method="POST" enctype="multipart/form-data" novalidate>
										<div class="mb-3">
											<label class="form-label">Name</label>
											<input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" />
										</div>
                                        <div class="mb-3">
										<label class="form-label">Faculity</label>
										<select class="form-select mb-3" id="faculty" name="faculty">
  <option selected>Select Faculty</option>
  <?php foreach($faculties as $faculty): ?>
    <option value="<?php echo $faculty['name']; ?>"><?php echo $faculty['name']; ?></option>
  <?php endforeach; ?>
</select>
	              						</div>
										  <div class="mb-3">
										<label class="form-label">Semester</label>
											<select class="form-select mb-3" id="semester" name="semester">
                                                <option selected>Select Semester</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
                                            </select>
	              						</div>
										<div class="text-center mt-3">
											<!-- <a href="index.php" class="btn btn-lg btn-primary">Add Faculity</a> -->
											<button type="submit" name="submit" class="btn btn-lg btn-primary">Add Course</button>
										</div>
									</form>
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