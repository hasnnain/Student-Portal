<?php
session_start();

@include 'connection/config.php';
@include 'connection/connect.php';
error_reporting(0);

if (!isset($_SESSION['name'])) {
    header('location:login.php');
    exit();
}

if (isset($_POST['submit'])) {
    $total_marks = $_POST['total_marks'];
    $obtained_marks = $_POST['obtained_marks'];

    $updid = $_GET['updid']; // Get the updid parameter from the URL

    $check = "SELECT total_marks,obtained_marks FROM final WHERE id='$updid'";
    $rescheck = mysqli_query($db, $check);

    if (mysqli_num_rows($rescheck) > 0) {
        $row = mysqli_fetch_assoc($rescheck);

        // Assign the existing column values if the corresponding fields are empty
        $total_marks = $total_marks == '' ? $row['total_marks'] : $total_marks;
        $obtained_marks = $obtained_marks == '' ? $row['obtained_marks'] : $obtained_marks;
    }

    $sql = "UPDATE final SET
        total_marks = '$total_marks',
        obtained_marks = '$obtained_marks'
        WHERE id='$updid'";

    $res = mysqli_query($db, $sql);

    if ($res) {
        $success = '<div class="alert alert-success alert-dismissible fade show mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Final Marks Updated Successfully.
                    </div>';
    } else {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Error updating final marks: ' . mysqli_error($db) . '
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
                                    <h1 class="h2">Update Final Marks</h1>
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
                                                    <label class="form-label">Total Marks</label>
                                                    <input class="form-control form-control-lg" type="number" name="total_marks" placeholder="Enter Total Marks" />
                                                    <label class="form-label">Obtained Marks</label>
                                                    <input class="form-control form-control-lg" type="number" name="obtained_marks" placeholder="Enter Obtained Marks" />
                                                </div>
                                                <div class="text-center mt-3">
                                                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Update Marks</button>
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
