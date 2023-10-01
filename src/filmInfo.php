<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Films</title>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
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
    echo "<h4>" . "Producers: " . "</h4>";
    // Wrap the producer images and names in a container div
    echo '<div class="producer-container">';
    $producers = $open_review_s_db->query("SELECT producerID, producer_name, image_url FROM producer WHERE producerID IN (SELECT producerID FROM film_producer WHERE filmID = $id)");
    while($row = $producers->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="producer-item">';
        echo "<img height='100' src='" . $row['image_url'] . "' alt='film_image'/><br />";
        echo "<p>" . $row['producer_name'] . "</p>";
        echo '</div>';
    }
    echo '</div>'; // Close the producer-container div
} elseif ($section === 'people') {
    // Handle the "People" section
} elseif ($section === 'planets') {
    // Handle the "Planets" section
} elseif ($section === 'vehicles') {
    // Handle the "Vehicles" section
} elseif ($section === 'starships') {
    // Handle the "Starships" section
}

?>
</body>
</html>