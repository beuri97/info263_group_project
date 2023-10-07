<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Films</title>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/star-wars" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">

    <!-- Scripts -->
    <script type = "text/javascript" src="js/filmsScript.js"></script>
</head>

<body>
<!-- Nav Bar Title -->
<div style="text-align: center;">
    <h1>Star Wars Project</h1>
</div>
<div style="text-align: center;">
    <img src="img/logo.png" width="200" alt='film_image'/>
</div>

<!-- Navigation -->
<div class='container-fluid padding-above'>
    <div class='row py-2 justify-content-center'>
        <div class='col-8 px-4'>
            <div style="text-align: left;">
                <nav>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="films.php">Films</a></li>
                        <li><a href="planets.php">Planets</a></li>
                        <li><a href="people.php">People</a></li>
                        <li><a href="form.php">Form</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Search -->
        <div class='col-4 px-4'>
            <div style="text-align: right;">
                <form>
                    <label for="search-bar">Search:</label>
                    <input type="text" id="search-bar" />
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<h2>Planets</h2>

<?php

try {
    $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
    $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

// Wrap the planet images and names in a container div
echo '<div class="cast-container">';
$producers = $open_review_s_db->query("SELECT planetID, planet_name, image_url FROM planet");
while($row = $producers->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="cast-item">';
    $img = explode('/revision',$row['image_url']);
    echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
    echo "<p>" . $row['planet_name'] . "</p>";
    echo '</div>';
}
echo '</div>'; // Close the planet-container div

?>

</body>
</html>
