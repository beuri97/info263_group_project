<?php
$errors = [];

if (empty($_POST["name"])) {
    $errors[] = "Name is required";
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required";
}

if (strlen($_POST["password"]) < 5) {
    $errors[] = "Password must be at least 5 characters";
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $errors[] = "Passwords must match";
}

if (empty($errors)) {
    require "resources/database.php";
    $password_hash = ($_POST["password"]);
    addUser($_POST['name'], $_POST['email'], $password_hash);
    require "signup-success.php";
}

// Handle errors
if (!empty($errors)) {
    foreach ($errors as $error)
    echo $error . "\n";
}