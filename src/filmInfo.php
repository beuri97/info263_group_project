<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Films</title>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">

    <!-- Scripts -->
    <script type = "text/javascript" src="js/filmsScript.js"></script>
</head>

<body>
<?php
try {
    $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
    $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

// Depending on the section, query the database and generate content
$id = $_GET['id'];
$section = $_GET['section'];
if ($section === 'producers') {
    // Handle the "producers" section
    echo "<h2>" . "Producers: " . "</h2>";
    // Wrap the producer images and names in a container div
    echo '<div class="producer-container">';
    $producers = $open_review_s_db->query("SELECT producerID, producer_name, image_url FROM producer WHERE producerID IN (SELECT producerID FROM film_producer WHERE filmID = $id)");
    while($row = $producers->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="producer-item">';
        $img = explode('/revision',$row['image_url']);
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
        echo "<p>" . $row['producer_name'] . "</p>";
        echo '</div>';
    }
    echo '</div>'; // Close the producer-container div

} elseif ($section === 'cast') {
    // Handle the "cast" section
    echo "<h2>" . "Cast: " . "</h2>";
    // Wrap the cast images and names in a container div
    echo '<div class="cast-container">';
    $cast = $open_review_s_db->query("SELECT peopleID, people_name, image_url FROM people WHERE peopleID IN (SELECT peopleID FROM film_people WHERE filmID = $id)");
    while($row = $cast->fetch(PDO::FETCH_ASSOC)) {
    ?> <a href='peopleinfo.php?id=<?php echo $row['peopleID']; ?>' class="cast-item"> <?php
        $img = explode('/revision',$row['image_url']);
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
        echo "<p>" . $row['people_name'] . "</p>";
        echo '</a>';
    }
    echo '</div>'; // Close the cast-container div

} elseif ($section === 'planets') {
    // Handle the "Planets" section
    echo "<h2>" . "planets: " . "</h2>";
    // Wrap the planet images and names in a container div
    echo '<div class="cast-container">';
    $planet = $open_review_s_db->query("SELECT planetID, planet_name, image_url FROM planet WHERE planetID IN (SELECT planetID FROM film_planet WHERE filmID = $id)");
    while($row = $planet->fetch(PDO::FETCH_ASSOC)) {
    ?> <a href='planetInfo.php?id=<?php echo $row['planetID']; ?>' class="cast-item"> <?php
        $img = explode('/revision',$row['image_url']);
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='planet_image'/><br />";
        echo "<p>" . $row['planet_name'] . "</p>";
        echo '</a>';
    }
    echo '</div>'; // Close the planet-container div

} elseif ($section === 'vehicles') {
    // Handle the "Vehicles" section
    echo "<h2>" . "vehicles: " . "</h2>";
    // Wrap the vehicles images and names in a container div
    echo '<div class="cast-container">';
    $vehicles = $open_review_s_db->query("SELECT vehicleID, vehicle_name, image_url FROM vehicle WHERE vehicleID IN (SELECT vehicleID FROM film_vehicles WHERE filmID = $id)");
    while($row = $vehicles->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="cast-item">';
        $img = explode('/revision',$row['image_url']);
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
        echo "<p>" . $row['vehicle_name'] . "</p>";
        echo '</div>';
    }
    echo '</div>'; // Close the vehicles-container div

} elseif ($section === 'starships') {
    // Handle the "Starships" section
    echo "<h2>" . "Starships: " . "</h2>";
    // Wrap the Starships images and names in a container div
    echo '<div class="cast-container">';
    $starships = $open_review_s_db->query("SELECT starshipID, starship_name, image_url FROM starship WHERE starshipID IN (SELECT starshipID FROM film_starships WHERE filmID = $id)");
    while($row = $starships->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="cast-item">';
        $img = explode('/revision',$row['image_url']);
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
        echo "<p>" . $row['starship_name'] . "</p>";
        echo '</div>';
    }
    echo '</div>'; // Close the Starships-container div
}

?>
</body>
</html>