<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data from the request body
    $formData = json_decode(file_get_contents('php://input'), true);

    // Perform database connection
    $host = "localhost"; // Replace with your actual database host
    $username = "root"; // Replace with your actual database username
    $password = ""; // Replace with your actual database password
    $dbname = "live_react"; // Replace with your actual database name

    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the database query
    $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $formData["name"], $formData["email"], $formData["phone"], $formData["password"]);

    if ($stmt->execute()) {
        // Form submitted successfully
        echo "Form submitted successfully!";
    } else {
        // Error occurred while submitting the form
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
