<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Employer Dashboard</title>
</head>
<body>
  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Welcome to Employer Dashboard</h1>
            <?php
            session_start();
            if (isset($_SESSION['employer_email'])) {
                echo "<p>Email: " . $_SESSION['employer_email'] . "</p>";
            } else {
                // Redirect to login page if session variable is not set
                header("Location: employer_login.php");
                exit();
            }
            ?>
            <!-- Add more dashboard content here -->
            <a href="post_job.php" class="btn btn-primary">Post a Job</a>
            <a href="manage_jobs.php" class="btn btn-secondary">Manage Posted Jobs</a>
            <a href="view_applications.php" class="btn btn-info">View Job Applications</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
