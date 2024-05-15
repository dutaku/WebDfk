<?php
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
if (isset($_POST['signupPhone']) && isset($_POST['signupName']) && isset($_POST['signupEmail']) && isset($_POST['signupPassword'])) {
    $phone = $_POST['signupPhone'];
    $name = $_POST['signupName'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Define the SQL query to insert data into the table
    $sql_query = "INSERT INTO Apply (phone, name, email, password) VALUES (?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($conn, $sql_query)) {
        // Bind parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "ssss", $phone, $name, $email, $hashed_password);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            echo "New details inserted successfully!";
        } else {
            // Show an error message if there was a problem executing the query
            echo "Error: " . $sql_query . "<br>" . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the connection to the database
mysqli_close($conn);
?>
