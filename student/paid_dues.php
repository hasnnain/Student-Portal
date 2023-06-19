<?php
@include 'connection/config.php';
@include 'connection/connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['name'])) {
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

                    <h1 class="h3 mb-3"><strong>Your Paid Dues</strong></h1>

                    <div class="row">
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <table class="table table-hover my-0">
                                    <thead>
                                        <tr>
                                            <th>Purpose</th>
                                            <th>Fee</th>
                                            <th class="d-none d-xl-table-cell">Due Date</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $sql = "SELECT * FROM fee WHERE status = '1' && student_id = '".$student['student_id']."' ORDER BY due_date";
                                        $query = mysqli_query($db, $sql);
                                        $totalFee = 0; // Variable to store the total fee

                                        if (!mysqli_num_rows($query) > 0) {
                                            echo '<td colspan="11"><center>No Paid Dues</center></td>';
                                        } else {
                                            while ($row = mysqli_fetch_array($query)) {
                                                $i++;
                                                $totalFee += $row['fee']; // Add the fee to the totalFee variable
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['purpose'] ?></td>
                                                    <td><?php echo $row['fee'] ?></td>
                                                    <td class="d-none d-xl-table-cell"><?php echo $row['due_date'] ?></td>
                                                    <td><a href="#"><span class="badge bg-primary">Paid</span></a></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td>Your Total Paid Dues = </td>
                                            <td><?php echo $totalFee ?></td>
                                        </tr>
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
