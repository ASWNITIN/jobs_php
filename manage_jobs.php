<?php
session_start();
require 'dbcon.php';

// Check if the user is logged in as an employer
if (!isset($_SESSION['employer_id'])) {
    $_SESSION['message'] = "Please log in to access this page.";
    header("Location: employer_login.php");
    exit();
}

// Fetch all jobs
$query = "SELECT * FROM jobs";
$result = mysqli_query($con, $query);

// Check if the query execution was successful
if ($result) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>Manage Jobs</title>
    </head>
    <body>
      
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Manage Jobs</h4>
                    </div>
                    <div class="card-body">
                        <!-- Job Listing Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Requirements</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $row['title']; ?></td>
                                        <td><?= $row['description']; ?></td>
                                        <td><?= $row['requirements']; ?></td>
                                        <td>
                                            <a href="edit_job.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>
                                            <a href="delete_job.php?id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
                                        </td>
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
    $_SESSION['message'] = "Failed to fetch jobs. Please try again later.";
    header("Location: employer_dashboard.php");
    exit();
}
?>
