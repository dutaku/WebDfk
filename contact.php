<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection details
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "Web_Promote_Dfk";

// Establish connection to the database
$conn = mysqli_connect($server_name, $username, $password, $database_name);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Define the SQL query to insert data into the table
    $sql_query = "INSERT INTO contact(name,email,subject,message) VALUES ('$name','$email','$subject','$message')";

    // Execute the query
    $result = mysqli_query($conn, $sql_query);
    if ($result) {
        echo "New details inserted successfully!";
    } else {
        // Show an error message if there was a problem executing the query
        echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
    }
}

// Close the connection to the database
mysqli_close($conn);
?>

