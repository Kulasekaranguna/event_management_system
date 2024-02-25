<?php
session_start(); // Start the session

require_once "db_connect.php"; // Include the database connection file

// Check if user is logged in
if (!isset($_SESSION['user_details'])) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $userData = $_SESSION['user_details']; // Get user data from session

    $file = $_FILES["profile_picture"];
    $fileName = $file["name"];
    $tempFilePath = $file["tmp_name"];
    $fileError = $file["error"];

    // Check for upload errors
    if ($fileError !== UPLOAD_ERR_OK) {
        echo "Error uploading file. Please try again.";
        exit();
    }

    // Define the upload directory
    $uploadDir = "uploads/";
    // Generate a unique filename to prevent overwriting existing files
    $uniqueFileName = uniqid() . '_' . $fileName;
    // Define the final file path
    $filePath = $uploadDir . $uniqueFileName;

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($tempFilePath, $filePath)) {
        // Update the user's profile picture path in the database
        $updateQuery = "UPDATE users SET profile_picture = '$filePath' WHERE id = " . $userData['id'];

        if ($mysqli->query($updateQuery) !== TRUE) {
            echo "Error updating profile picture: " . $mysqli->error;
            exit();
        }

        // Redirect back to the customer homepage
        header("Location: customerhomepage.php");
        exit();
    } else {
        echo "Error uploading file. Please try again.";
        exit();
    }
} else {
    // Redirect to the customer homepage if the form was not submitted
    header("Location: customerhomepage.php");
    exit();
}
?>
