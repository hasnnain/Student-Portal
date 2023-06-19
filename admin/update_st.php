<?php
session_start();

@include 'connection/config.php';
@include 'connection/connect.php';
error_reporting(0);

if (!isset($_SESSION['name'])) {
    header('location:login.php');
    exit();
}

// Fetch faculties from the database
$facultyQuery = "SELECT * FROM faculty";
$facultyResult = mysqli_query($db, $facultyQuery);
$faculties = mysqli_fetch_all($facultyResult, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];

    $updid = $_GET['updid']; // Get the updid parameter from the URL

    $check = "SELECT name,email FROM student WHERE id='$updid'";
    $rescheck = mysqli_query($db, $check);

    if (mysqli_num_rows($rescheck) > 0) {
        $row = mysqli_fetch_assoc($rescheck);

        // Assign the existing column values if the corresponding fields are empty
        $name = $name == '' ? $row['name'] : $name;
        $email = $email == '' ? $row['email'] : $email;
        $faculty = $faculty == '' ? $row['faculty'] : $faculty;
        $semester = $semester == '' ? $row['semester'] : $semester;
    }

    $sql = "UPDATE student SET
        name = '$name',
        email = '$email',
        faculty = '$faculty',
        semester = '$semester'
        WHERE id='$updid'";

    $res = mysqli_query($db, $sql);

    if ($res) {
        $success = '<div class="alert alert-success alert-dismissible fade show mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Student Data Updated Successfully.
                    </div>';
    } else {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    Error updating student data: ' . mysqli_error($db) . '
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
                                    <h1 class="h2">Update Student Data</h1>
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
                                                    <label class="form-label">Name</label>
                                                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter Student Full Name" />
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter Student Email" />
                                                    <label class="form-label">Faculty</label>
                                                    <select class="form-select mb-3" id="faculty" name="faculty">
                                                        <option selected>Select Faculty</option>
                                                        <?php foreach ($faculties as $faculty) : ?>
                                                            <option value="<?php echo $faculty['name']; ?>"><?php echo $faculty['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label class="form-label">Semester</label>
                                                    <select class="form-select mb-3" name="semester">
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
                                                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Update Student</button>
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
