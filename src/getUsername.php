<?php
session_start(); // Start the session to access session variables

// Check if the 'username' session variable is set
if (isset($_SESSION['username'])) {
    // Return the username as a JSON response
    echo json_encode(['username' => $_SESSION['username']]);
} else {
    // Handle the case where the username is not set
    echo json_encode(['username' => '']); // or any other appropriate response
}