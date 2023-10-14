<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>

  <?php
    include 'headerPage.html';
    ?>

  <meta charset="UTF-8">
  <title>Signup</title>
  <script src="js/script.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
  <!-- CSS libraries -->
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
<h1 style="text-align: center; padding-bottom: 30px; padding-top: 30px">Sign up</h1>
<div style="display: flex; justify-content: center;">
    <form method="post" novalidate style="text-align: center; width: 200px">
        <div style="padding-bottom: 20px">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
        </div>

        <div style="padding-bottom: 20px">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>

        <div style="padding-bottom: 20px">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>

        <div style="padding-bottom: 20px">
            <label for="password_confirmation">Repeat Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button>Sign Up</button>
    </form>
</div>

<?php
$errors = [];

if (isset($_POST["email"]) and isset($_POST["name"]) and isset($_POST["password"]) and isset($_POST["password_confirmation"])) {
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

    if (!preg_match('/[0-9]/', $_POST["password"])) {
        $errors[] = "Password must contain a number";
    }

    if (empty($errors)) {
        require "resources/database.php";
        $emailError = uniqueEmail($_POST["email"]);
        if ($emailError != ''){
            echo '<p style="text-align: center; padding-top: 20px; color: red">' . $emailError . "\n" . '</p>';
            echo '<p style="text-align: center; padding: 20px">' . "Try Again" . "\n" . '</p>';
        } else {
            $password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);
            addUser($_POST['name'], $_POST['email'], $password_hash);
            echo '<p style="text-align: center; padding: 20px">' . "SUCCESS" . "\n" . '</p>';
            echo '<meta http-equiv="refresh" content="2;url=signup-success.php">';
            exit();
        }
    }

    // Handle errors
    if (!empty($errors)) {
        foreach ($errors as $error)
        {
            echo '<p style="text-align: center; padding-top: 20px; color: red">' . $error . "\n" . '</p>';
        }
        echo '<p style="text-align: center; padding: 20px">' . "Try Again" . "\n" . '</p>';
    }
}
?>
</body>
</html>