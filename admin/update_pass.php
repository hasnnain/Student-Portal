<?php
session_start();

include 'config.php';
include 'connection/conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['name'])) {
    header('location:login.php');
    exit();
}

if(isset($_POST['submit'])){
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    $chg_pwd = "SELECT * FROM admin WHERE name = ?";
    $stmt = $conn->prepare($chg_pwd);
    $stmt->bind_param("s", $_SESSION['name']);
    $stmt->execute();
    $result = $stmt->get_result();
    $chg_pwd1 = $result->fetch_array();
    $data_pwd = $chg_pwd1['password'];

    if($data_pwd == $old_pass){
        if($new_pass == $confirm_pass){
            $update_pwd = "UPDATE admin SET password = ? WHERE name = ?";
            $stmt = $conn->prepare($update_pwd);
            $stmt->bind_param("ss", $new_pass, $_SESSION['name']);
            if ($stmt->execute()) {
                $success = '<div class="alert alert-success alert-dismissible fade show mt-2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Password Updated Successfully.
                </div>';
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Error updating password: ' . $stmt->error . '
                </div>';
            }
            $stmt->close();
        } else {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                New password and confirm password do not match.
            </div>';
        }
    } else {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Incorrect old password.
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

    <title>Update Password | AdminKit Demo</title>

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
                                    <h1 class="h2">Update Your Password</h1>
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
                                                    <label class="form-label">Old Password</label>
                                                    <input class="form-control form-control-lg" type="password" name="old_pass" placeholder="Enter Your Old Password" required/>
                                                    <label class="form-label">New Password</label>
                                                    <input class="form-control form-control-lg" type="password" name="new_pass" placeholder="Enter Your New Password" required/>
                                                    <label class="form-label">Confirm Password</label>
                                                    <input class="form-control form-control-lg" type="password" name="confirm_pass" placeholder="Confirm Your Password" required/>
                                                </div>
                                                <div class="text-center mt-3">
                                                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Update Password</button>
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