<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the POST request
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];

    // Database connection
    $server = "localhost";
    $username = "root";
    $password = ""; 
    $database = "reg"; 

    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO registration(firstName, lastName, email, password, phoneNumber) VALUES (?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sssss", $firstName, $lastName, $email, $password, $phoneNumber);

        // Execute the statement
        $execVal = $stmt->execute();

        // Check for errors during execution
        if ($execVal) {
            echo "Registration successful...";
        } else {
            echo "Error during registration: " . $stmt->error;
        }

        // Close the statement and the connection
        $stmt->close();
        $conn->close();
    }
}
?>



