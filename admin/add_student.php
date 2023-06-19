
<?php
  @include 'connection/config.php';
  @include 'connection/connect.php';	
 error_reporting(0);

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
		if(empty(empty($_POST['student_id'])||$_POST['name'])||empty($_POST['email'])|empty($_POST['faculty'])||$_POST['semester']=='')
		{
			$error =   '<div class="alert alert-danger alert-dismissible fade show">
				           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  <strong>All fields Must be Fillup!</strong>
						</div>';
		}else
		{
       $fname = $_FILES['file']['name'];
       $temp = $_FILES['file']['tmp_name'];
       $fsize = $_FILES['file']['size'];
       $extension = explode('.',$fname);
       $extension = strtolower(end($extension));
       $fnew = uniqid().'.'.$extension;
			 $store = "../student/studentImages/".basename($fnew);
					if($extension == 'jpg'||$extension == 'png'||$extension == 'gif'||$extension == 'jpeg' )
					{
						if($fsize>=1e+7)
						{
						    $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									    <strong>Max Image Size is 10MB!</strong> Try different Image.
									  </div>';
						}else
						{
                $email = $_POST['email'];
                $student_id = $_POST['student_id'];
					    	$sql = "INSERT INTO student(student_id,name,email,password,faculty,semester,photo) VALUE('".$student_id."','".$_POST['name']."','".$email."','".$_POST['password']."','".$_POST['faculty']."','".$_POST['semester']."','".$fnew."')"; 
                $check = "SELECT email,student_Id FROM student where (email='$email' or student_Id='$reg_num');";
                $rescheck=mysqli_query($db,$check);
                if(mysqli_num_rows($rescheck) > 0)
                {
                  $row = mysqli_fetch_assoc($rescheck);
                  if($email==isset($row['email']))
                  {
                     $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <strong>This Student Email is Already Registered.</strong>
                               </div>';
                  }
                  if($student_id==isset($row['student_id']))
                  {
                     $error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
									               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									               <strong>This Student ID is Already Registered.</strong>
									             </div>';
                  }
                }else
                {
                  $res = mysqli_query($db, $sql);
                  move_uploaded_file($temp, $store);
                  $success = 	'<div class="alert alert-success alert-dismissible fade show mt-2">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          You Registered Successfully.
                         </div>';
                }

						}
					}elseif($extension == '')
					{
						$error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>select image!</strong>
				                 </div>';
					}else
          {
						$error = '<div class="alert alert-danger alert-dismissible fade show mt-2">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>invalid extension!</strong>jpg, png, gif or jpeg  are accepted.
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
                  <h1 class="h2">Add New Student</h1>
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
                      <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label class="form-label">Student ID</label>
                          <input class="form-control form-control-lg" type="text" name="student_id" placeholder="Issue Student Registration Number" />
                          <label class="form-label">Name</label>
                          <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter Student Full Name" />
                          <label class="form-label">Email</label>
                          <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter Student Email" />
                          <label class="form-label">Password</label>
                          <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter Password for Student Portal" />
                          <label class="form-label">Faculty</label>
                          <select class="form-select mb-3" id="faculty" name="faculty">
                            <option selected>Select Faculty</option>
                            <?php foreach($faculties as $faculty): ?>
                            <option value="<?php echo $faculty['name']; ?>"><?php echo $faculty['name']; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <label class="form-label">Semester</label>
                          <select class="form-select mb-3" name="semester">
                            <option selected>Select Semester</option>
                            <option>1</option>
                            <option>5</option>
                          </select>
                          <label class="form-label">Photo</label>
                          <input class="form-control form-control-lg" type="file" name="file" placeholder="Add Picture of Student" />
                        </div>
                        <div class="text-center mt-3">
                          <button type="submit" name="submit" class="btn btn-lg btn-primary">Add Student</button>
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

