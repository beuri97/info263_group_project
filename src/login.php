
<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <title>Login - Star Wars - INFO263</title>
    <script src="js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <!-- CSS libraries -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>


<h1>Login</h1> <br>

<form method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Password</label>
    <input type="password" name="password" id="pwd">

    <button>Log in</button>
</form>

<?php
require 'resources/database.php';
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['email'])){
        try {
        $db_email = $_POST['email'];
        $db = openConnection();
        $query = "SELECT email, password_hash FROM registered_users WHERE email = '$db_email'";
        $stmt = $db->query($query);
        $user = $stmt->fetch(PDO::FET CH_ASSOC);
        if ($user) {
            if ($_POST["password"] == $user["password_hash"]) {
                die("Login Successful"); //switch to homepage, in the corner of the nav bar put the user name.
            }
        }
        $is_invalid = true;
        } catch (PDOException $e) {
            // Handle any database-related errors here, e.g., log the error or display an error message.
            echo "Database Error: " . $e->getMessage();
        }
    }
}
?>

<?php if ($is_invalid): ?>
    <em>Invalid Login</em>
<?php endif; ?>

</body>
</html>
