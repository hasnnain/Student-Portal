<?php
@include 'connection/config.php';
@include 'connection/connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['name'])) {
    header('location:login.php');
}

// Function to get the total number of presents for a student
function getTotalPresents($studentId, $db)
{
    $query = "SELECT COUNT(*) as total_presents FROM attendance WHERE student_id = '$studentId' AND status = '1'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_presents'];
}

// Function to get the total number of absents for a student
function getTotalAbsents($studentId, $db)
{
    $query = "SELECT COUNT(*) as total_absents FROM attendance WHERE student_id = '$studentId' AND status = '2'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total_absents'];
}

if (isset($_GET['pstudent_id'])) {
    $studentId = $_GET['pstudent_id'];
    $date = date('Y-m-d');

    // Check if the student has already been marked present on the same day
    $existingQuery = "SELECT * FROM attendance WHERE student_id = '$studentId' AND date = '$date'";
    $existingResult = mysqli_query($db, $existingQuery);

    if (mysqli_num_rows($existingResult) > 0) {
        // Student has already been marked present/absent, display an alert
        echo '<script>';
        echo 'alert("Attendance already marked for this student today.");';
        echo 'window.location.href = "attendance.php";'; // Redirect back to attendance.php
        echo '</script>';
        exit();
    } else {
        // Insert the attendance record for the student
        $status = '1';
        $query = "INSERT INTO attendance (student_id, status, date) VALUES ('$studentId', '$status', '$date')";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Insertion successful
            header('Location: attendance.php'); // Redirect back to attendance.php
            exit();
        } else {
            // Insertion failed
            echo "Error: " . mysqli_error($db);
        }
    }
}

if (isset($_GET['astudent_id'])) {
    $studentId = $_GET['astudent_id'];
    $date = date('Y-m-d');

    // Check if the student has already been marked absent on the same day
    $existingQuery = "SELECT * FROM attendance WHERE student_id = '$studentId' AND date = '$date'";
    $existingResult = mysqli_query($db, $existingQuery);

    if (mysqli_num_rows($existingResult) > 0) {
        // Student has already been marked present/absent, display an alert
        echo '<script>';
        echo 'alert("Attendance already marked for this student today.");';
        echo 'window.location.href = "attendance.php";'; // Redirect back to attendance.php
        echo '</script>';
        exit();
    } else {
        // Insert the attendance record for the student
        $status = '2';
        $query = "INSERT INTO attendance (student_id, status, date) VALUES ('$studentId', '$status', '$date')";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Insertion successful
            header('Location: attendance.php'); // Redirect back to attendance.php
            exit();
        } else {
            // Insertion failed
            echo "Error: " . mysqli_error($db);
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

                    <h1 class="h3 mb-3"><strong>Present Students</strong></h1>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Attendance Details</h5>
                                </div>
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Total Presents</th>
                                            <th>Total Absents</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM student ORDER BY name";
                                        $query = mysqli_query($db, $sql);
                                        if (!mysqli_num_rows($query) > 0) {
                                            echo '<tr><td colspan="5"><center>No Student</center></td></tr>';
                                        } else {
                                            while ($row = mysqli_fetch_array($query)) {
                                                $studentId = $row['student_id'];
                                                $totalPresents = getTotalPresents($studentId, $db);
                                                $totalAbsents = getTotalAbsents($studentId, $db);
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['student_id'] ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php echo $totalPresents ?></td>
                                                    <td><?php echo $totalAbsents ?></td>
                                                    <td>
                                                        <a href="attendance.php?pstudent_id=<?php echo $row['student_id'] ?>"><span class="badge bg-primary">Present</span></a>
                                                        <a href="attendance.php?astudent_id=<?php echo $row['student_id'] ?>"><span class="badge bg-danger">Absent</span></a>
                                                    </td>
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
