<?php
session_start();
require 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if the email is already registered
    $query = "SELECT * FROM employers WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // If the email is already registered, redirect back to the signup page with an error message
        $_SESSION['message'] = "Email is already registered.";
        header("Location: employer_signup.php");
        exit();
    } else {
        // Insert the new employer into the database
        $insert_query = "INSERT INTO employers (name, email, password) VALUES ('$name', '$email', '$password')";
        $insert_result = mysqli_query($con, $insert_query);

        if ($insert_result) {
            // If registration is successful, set session variables and redirect to the employer dashboard or any other page
            $_SESSION['employer_id'] = mysqli_insert_id($con);
            $_SESSION['employer_email'] = $email;
            // You may set more session variables if needed

            // Redirect to employer dashboard or any other page
            header("Location: employer_dashboard.php");
            exit();
        } else {
            // If registration fails, redirect back to the signup page with an error message
            $_SESSION['message'] = "Registration failed. Please try again.";
            header("Location: employer_signup.php");
            exit();
        }
    }
} else {
    // If the request method is not POST, redirect back to the signup page
    header("Location: employer_signup.php");
    exit();
}
?>
