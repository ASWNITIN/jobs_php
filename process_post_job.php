<?php
session_start();
require 'dbcon.php';

// Check if the user is logged in as an employer
if (!isset($_SESSION['employer_email'])) {
    $_SESSION['message'] = "Please log in to post a job.";
    header("Location: employer_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $requirements = mysqli_real_escape_string($con, $_POST['requirements']);
    $employer_email = $_SESSION['employer_email']; // Assuming employer_id is stored in the session

    // Insert job into database
    $query = "INSERT INTO jobs (title, description, requirements, employer_email) VALUES ('$title', '$description', '$requirements', '$employer_email')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['message'] = "Job posted successfully.";
        header("Location: employer_dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to post job. Please try again.";
        header("Location: post_job.php");
        exit();
    }
} else {
    // Redirect if accessed directly
    header("Location: post_job.php");
    exit();
}
?>
