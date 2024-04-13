<?php
session_start();
require 'dbcon.php';

if(isset($_POST['register_job_seeker'])) {
    // Retrieve form data
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $skills = mysqli_real_escape_string($con, $_POST['skills']);

    // Check if email is already registered
    $check_email_query = "SELECT * FROM job_seekers WHERE email='$email'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_result) > 0) {
        $_SESSION['message'] = "Email is already registered.";
        header("Location: job_seeker_signup.php");
        exit();
    } else {
        // Insert the data into the job_seekers table
        $insert_query = "INSERT INTO job_seekers (name, email, phone, password, skills) VALUES ('$name', '$email', '$phone', '$password', '$skills')";
        $insert_result = mysqli_query($con, $insert_query);

        if($insert_result) {
            $_SESSION['message'] = "Registration successful. You can now log in.";
            header("Location: job_seeker_login.php");
            exit();
        } else {
            $_SESSION['message'] = "Registration failed. Please try again.";
            header("Location: job_seeker_signup.php");
            exit();
        }
    }
} else {
    $_SESSION['message'] = "Access denied.";
    header("Location: job_seeker_signup.php");
    exit();
}
?>
