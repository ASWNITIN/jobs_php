<?php
session_start();
require 'dbcon.php';

// Check if the user is logged in as a job seeker
if (!isset($_SESSION['job_seeker_id'])) {
    $_SESSION['message'] = "Please log in to access this page.";
    header("Location: job_seeker_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
    // Fetch job details by $job_id
    $query = "SELECT * FROM jobs WHERE id='$job_id'";
    $result = mysqli_query($con, $query);
    $job = mysqli_fetch_assoc($result);
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Job Application</title>
</head>
<body>
  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Apply for Job: <?= $job['title']; ?></h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST">
                        <input type="hidden" name="job_id" value="<?= $job['id']; ?>">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Skills</label>
                            <input type="text" name="skills" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Cover Letter</label>
                            <textarea name="cover_letter" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="apply_job" class="btn btn-primary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
