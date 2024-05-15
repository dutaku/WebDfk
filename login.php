<?php
session_start();

// Include database connection
include('db_connect');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $phone = $_POST['loginPhone'];
    $password = $_POST['loginPassword'];

    // Perform query to check if user exists
    $query = "SELECT * FROM users WHERE phone='$phone' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // Check if user exists and credentials match
    if (mysqli_num_rows($result) == 1) {
        // Set session variables
        $_SESSION['login_user'] = $phone;
        
        // Redirect to dashboard or another page upon successful login
        header("Location: dashboard.php");
    } else {
        // Invalid credentials, redirect back to login page with error message
        header("Location: login.html?error=invalid_credentials");
    }
} else {
    // Redirect back to login page if accessed directly
    header("Location: login.html");
}
?>
