<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Edit Job</title>
</head>
<body>
  
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>Edit Job</h1>
            <?php
            session_start();
            require 'dbcon.php';

            // Check if the user is logged in as an employer
            if (!isset($_SESSION['employer_id'])) {
                $_SESSION['message'] = "Please log in to edit jobs.";
                header("Location: employer_login.php");
                exit();
            }

            if (isset($_GET['id'])) {
                $job_id = $_GET['id'];
                // Fetch job details by $job_id
                $query = "SELECT * FROM jobs WHERE id='$job_id'";
                $result = mysqli_query($con, $query);
                $job = mysqli_fetch_assoc($result);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = mysqli_real_escape_string($con, $_POST['title']);
                $description = mysqli_real_escape_string($con, $_POST['description']);
                $requirements = mysqli_real_escape_string($con, $_POST['requirements']);

                // Update job details in the database
                $query = "UPDATE jobs SET title='$title', description='$description', requirements='$requirements' WHERE id='$job_id'";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $_SESSION['message'] = "Job updated successfully.";
                    header("Location: manage_jobs.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Failed to update job. Please try again.</div>";
                }
            }
            ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $job['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= $job['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="requirements" class="form-label">Requirements</label>
                    <textarea class="form-control" id="requirements" name="requirements" rows="3"><?= $job['requirements']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
