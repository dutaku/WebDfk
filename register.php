<?php
session_start();

// Include database connection
include('db_connect');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['signupName'];
    $email = $_POST['signupEmail'];
    $phone = $_POST['signupPhone'];
    $password = $_POST['signupPassword'];

    // Perform query to insert new user record
    $query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
    $result = mysqli_query($conn, $query);

    // Check if insertion was successful
    if ($result) {
        // Set session variables
        $_SESSION['login_user'] = $phone;

        // Redirect to dashboard or another page upon successful registration
        header("Location: dashboard.php");
    } else {
        // Registration failed, redirect back to registration page with error message
        header("Location: register.html?error=registration_failed");
    }
} else {
    // Redirect back to registration page if accessed directly
    header("Location: register.html");
}
?>
