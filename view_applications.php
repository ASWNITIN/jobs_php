<?php
session_start();
require 'dbcon.php';

// Check if the user is logged in as an employer
if (!isset($_SESSION['employer_email'])) {
    $_SESSION['message'] = "Please log in to access this page.";
    header("Location: employer_login.php");
    exit();
}

// Fetch job applications for the logged-in employer
$employer_email = $_SESSION['employer_email'];
$query = "SELECT * FROM job_applications WHERE job_id IN (SELECT id FROM jobs WHERE employer_email='$employer_email')";
$result = mysqli_query($con, $query);

// Check if there are any job applications
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>View Job Applications</title>
    </head>
    <body>
      
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>View Job Applications</h4>
                    </div>
                    <div class="card-body">
                        <!-- Job Applications Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Skills</th>
                                    <th>Cover Letter</th>
                                    <th>Application Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['name']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['phone']; ?></td>
                                        <td><?= $row['skills']; ?></td>
                                        <td><?= $row['cover_letter']; ?></td>
                                        <td><?= $row['application_date']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
} else {
    $_SESSION['message'] = "No job applications found.";
    header("Location: employer_dashboard.php");
    exit();
}
?>
