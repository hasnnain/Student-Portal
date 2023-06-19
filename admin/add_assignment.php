<?php
@include 'connection/config.php';
@include 'connection/conn.php';
@include 'connection/connect.php';
error_reporting(0);

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['name'])) {
    header('location:login.php');
}

// Fetch students from the database
$studentQuery = "SELECT * FROM student";
$studentResult = mysqli_query($db, $studentQuery);
$students = mysqli_fetch_all($studentResult, MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
    if ($_POST['assignment'] == '') {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Enter Assignment Name!</strong>
                  </div>';
    } else {
        $sql = "INSERT INTO assignment(student_id,assignment,total_marks,obtained_marks,date) VALUE('".$_POST['student_id']."','".$_POST['assignment']."','".$_POST['total_marks']."','".$_POST['obtained_marks']."','".$_POST['date']."')";
        // $res = mysqli_stmt_execute($stmt);

        if ($conn->query($sql)==TRUE) {
            $success = '<div class="alert alert-success alert-dismissible fade show mt-2">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          Assignment Marks Added Successfully.
                        </div>';
        } else {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error in adding assignment marks.</strong>
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
            <?php include "includes/nav.php"; ?>

            <main class="d-flex w-100">
                <div class="container d-flex flex-column">
                    <div class="row vh-100">
                        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                            <div class="d-table-cell align-middle">
                                <div class="text-center mt-4">
                                    <h1 class="h2">Add Assignment Marks</h1>
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
                                                    <label class="form-label">Student</label>
                                                    <select class="form-select mb-3" id="student_id" name="student_id">
                                                        <option selected>Select Student By ID</option>
                                                        <?php foreach ($students as $student) : ?>
                                                            <option value="<?php echo $student['student_id']; ?>"><?php echo $student['student_id']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label class="form-label">Assignment Name</label>
                                                    <input class="form-control form-control-lg" type="text" name="assignment" placeholder="Enter Assignment Name" />
                                                    <label class="form-label">Total Marks</label>
                                                    <input class="form-control form-control-lg" type="number" name="total_marks" placeholder="Enter Total Marks" />
                                                    <label class="form-label">Obtained Marks</label>
                                                    <input class="form-control form-control-lg" type="number" name="obtained_marks" placeholder="Enter Obtained Marks" />
                                                    <label class="form-label">Assignment Date</label>
                                                    <input class="form-control form-control-lg" type="date" name="date" />
                                                </div>
                                                <div class="text-center mt-3">
                                                    <button type="submit" name="submit" class="btn btn-lg btn-primary">Add Marks</button>
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
