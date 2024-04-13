<?php
session_start();
require 'dbcon.php';
if (!isset($_SESSION['job_seeker_id'])) {
    $_SESSION['message'] = "Please log in to access this page.";
    header("Location: job_seeker_login.php");
    exit();
}
// Fetch all jobs initially
$query = "SELECT * FROM jobs";
$result = mysqli_query($con, $query);

// If filtering is applied
if(isset($_GET['filter'])) {
    $filter = mysqli_real_escape_string($con, $_GET['filter']);
    $keyword = mysqli_real_escape_string($con, $_GET['keyword']);

    // Modify the query based on the filter selected
    switch ($filter) {
        case 'title':
            $query = "SELECT * FROM jobs WHERE title LIKE '%$keyword%'";
            break;
        case 'employer':
            $query = "SELECT * FROM jobs WHERE employer_name LIKE '%$keyword%'";
            break;
        case 'skills':
            $query = "SELECT * FROM jobs WHERE requirements LIKE '%$keyword%'";
            break;
        default:
            // Default query (fetch all jobs)
            $query = "SELECT * FROM jobs";
            break;
    }

    // Execute the modified query
    $result = mysqli_query($con, $query);
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

    <title>Job Listing</title>
</head>
<body>
  
<div class="container mt-5">
    <!-- Logout Button -->
    <div class="text-end mb-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Job Listings</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Form -->
                    <form action="" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="filter" class="form-select">
                                    <option value="title">Title</option>
                                    <option value="employer">Employer Name</option>
                                    <option value="skills">Skills Required</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="keyword" class="form-control" placeholder="Enter keyword">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="job_listing.php" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>

                    <!-- Job Listing Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Requirements</th>
                                <th>Employer Name</th>
                                <th>Employer Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['title']; ?></td>
                                    <td><?= $row['description']; ?></td>
                                    <td><?= $row['requirements']; ?></td>
                                    <td><?= $row['employer_name']; ?></td>
                                    <td><?= $row['employer_email']; ?></td>
                                    <td>
                                        <a href="job_application.php?id=<?= $row['id']; ?>" class="btn btn-primary">Apply</a>
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
