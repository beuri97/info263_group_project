
<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <title>Login - Star Wars - INFO263</title>

    <?php
    session_start(); // Start the session
    $_SESSION['username'] = null;
    include 'headerPage.html';
    ?>

    <script src="js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <!-- CSS libraries -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>


<h1 style="text-align: center; padding-bottom: 30px; padding-top: 30px">Log In</h1>
<div style="display: flex; justify-content: center;">
    <form method="post" style="text-align: center; width: 200px">
        <div style="padding-bottom: 20px">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>

        <div style="padding-bottom: 20px">
            <label for="password">Password</label>
            <input type="password" name="password" id="pwd">
        </div>

        <button>Log in</button>
    </form>
</div>

<?php
require 'resources/database.php';
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['email'])){
        try {
        $db_email = $_POST['email'];
        $db = openConnection();
        $query = "SELECT email, username, password_hash FROM registered_users WHERE email = '$db_email'";
        $stmt = $db->query($query);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            if (password_verify($_POST['password'], $user['password_hash'])) {
                echo '<em>Successful Login</em>';
                $_SESSION['username'] = $user['username']; // Store the username in a session variable
                echo '<meta http-equiv="refresh" content="2;url=index.php">';
            } else {
                $is_invalid = true;
            }
        } else {
            $is_invalid = true;
        }
        } catch (PDOException $e) {
            // Handle any database-related errors here, e.g., log the error or display an error message.
            echo "Database Error: " . $e->getMessage();
        }
    }
}
?>

<?php if ($is_invalid): ?>
<div style="display: flex; justify-content: center; padding-top: 20px">
    <em style="text-align: center; align-content: center;";>Invalid Login</em>
</div>
<?php endif; ?>

</body>
</html>
