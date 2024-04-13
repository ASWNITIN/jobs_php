<?php
session_start();
require 'dbcon.php';

// Job Seeker Registration
if(isset($_POST['register_job_seeker'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $skills = mysqli_real_escape_string($con, $_POST['skills']);

    // Upload resume
    $resume_path = '';
    if ($_FILES['resume']['name']) {
        $resume_name = $_FILES['resume']['name'];
        $resume_tmp = $_FILES['resume']['tmp_name'];
        $resume_path = 'resumes/' . $resume_name;
        move_uploaded_file($resume_tmp, $resume_path);
    }

    $query = "INSERT INTO job_seekers (name, email, phone, skills, resume_path) VALUES ('$name', '$email', '$phone', '$skills', '$resume_path')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['message'] = "Registration successful";
        header("Location: job_seeker_register.php");
        exit();
    } else {
        $_SESSION['message'] = "Registration failed";
        header("Location: job_seeker_register.php");
        exit();
    }
}

// Job Application
if(isset($_POST['apply_job'])) {
    $job_id = mysqli_real_escape_string($con, $_POST['job_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $skills = mysqli_real_escape_string($con, $_POST['skills']);
    $cover_letter = mysqli_real_escape_string($con, $_POST['cover_letter']);

    $query = "INSERT INTO job_applications (job_id, name, email, phone, skills, cover_letter) VALUES ('$job_id', '$name', '$email', '$phone', '$skills', '$cover_letter')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $_SESSION['message'] = "Application submitted successfully";
        header("Location: job_listing.php");
        exit();
    } else {
        $_SESSION['message'] = "Application submission failed";
        header("Location: job_application.php?id=$job_id");
        exit();
    }
}
?>
