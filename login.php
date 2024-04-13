<?php
session_start();
require 'dbcon.php';

if(isset($_POST['login_job_seeker'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM job_seekers WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['job_seeker_id'] = $row['id'];
        $_SESSION['job_seeker_name'] = $row['name'];
        header("Location: job_listing.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid email/password combination";
        header("Location: job_seeker_login.php");
        exit();
    }
}
?>
