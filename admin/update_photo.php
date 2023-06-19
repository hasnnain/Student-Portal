<?php
session_start();

include 'config.php';
include 'connection/conn.php';
include 'connection/connect.php';
error_reporting(0);

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['name'])) {
    header('location:login.php');
    exit();
}
   if(isset($_POST['submit']))
   {
	
				$fname = $_FILES['file']['name'];
				$temp = $_FILES['file']['tmp_name'];
				$fsize = $_FILES['file']['size'];
				$extension = explode('.',$fname);
				$extension = strtolower(end($extension));
				$fnew = uniqid().'.'.$extension;
				$store = "adminImages/".basename($fnew);
					if($extension == 'jpg'||$extension == 'png'||$extension == 'jpeg'||$extension == 'gif'||$extension == 'heif'  )
					{
						if($fsize>=1e+7)
						{
						    $error = '<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									    <strong>Max Image Size is 10MB!</strong> Try different Image.
									  </div>';
						}else
						{
					    	$sql = "UPDATE admin set
                             photo='$fnew'
                             where name = '".$_SESSION['name']."'";
                               // store the submited data ino the database :images
							mysqli_query($db, $sql);
							move_uploaded_file($temp, $store);
							$success = 	'<div class="alert alert-success alert-dismissible fade show">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											Your Image Updated Successfully.
										 </div>';
						}
					}elseif($extension == '')
					{
						$error = '<div class="alert alert-danger alert-dismissible fade show">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>select Your image</strong>
				                 </div>';
					}else
                    {
						$error = '<div class="alert alert-danger alert-dismissible fade show">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>invalid extension!</strong>png, jpg, jpeg, Gif, heif are accepted.
								 </div>';
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
            <?php include "includes/nav.php"; ?>

            <main class="d-flex w-100">
                <div class="container d-flex flex-column">
                    <div class="row vh-100">
                        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                            <div class="d-table-cell align-middle">
                                <div class="text-center mt-4">
                                    <h1 class="h2">Update Your Picture</h1>
                                    <p>
                                        <?php
                                        if (isset($error)) {
                                            echo $error;
                                        }
                                        if (isset($success)) {
                                            echo $success;
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="m-sm-4">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label class="form-label">Select Picture</label>
                                                    <input class="form-control form-control-lg" type="file" name="file" placeholder="Select Picture" />
                                                </div>
                                                <div class="text-center mt-3">
                                                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Update Picture</button>
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
