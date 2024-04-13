<?php
session_start();
require 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check if the provided credentials match an employer in the database
    $query = "SELECT * FROM employers WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        // If a matching record is found, set session variables and redirect to dashboard or desired page
        $employer = mysqli_fetch_assoc($result);
        $_SESSION['employer_id'] = $employer['id'];
        $_SESSION['employer_email'] = $employer['email'];
        // You may set more session variables if needed

        // Redirect to employer dashboard or any other page
        header("Location: employer_dashboard.php");
        exit();
    } else {
        // If no matching record is found, redirect back to the login page with an error message
        $_SESSION['message'] = "Invalid email or password.";
        header("Location: employer_login.php");
        exit();
    }
} else {
    // If the request method is not POST, redirect back to the login page
    header("Location: employer_login.php");
    exit();
}
?>
