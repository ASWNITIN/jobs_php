<?php
session_start();
require 'dbcon.php';

// Check if the user is logged in as an employer
if (!isset($_SESSION['employer_id'])) {
    $_SESSION['message'] = "Please log in to delete jobs.";
    header("Location: employer_login.php");
    exit();
}

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    // Delete the job from the database
    $query = "DELETE FROM jobs WHERE id='$job_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['message'] = "Job deleted successfully.";
    } else {
        $_SESSION['message'] = "Failed to delete job. Please try again.";
    }
}

header("Location: manage_jobs.php");
exit();
?>
