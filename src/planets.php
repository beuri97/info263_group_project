<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Planets</title>
    <meta name="description" content="Journey to distant worlds in the Star Wars galaxy.
    Discover fascinating details, climates, and other information of iconic planets. Explore the wonders of Star Wars planets here.">
    <?php
    include 'headerPage.html';
    ?>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">

    <!-- Scripts -->
    <script type = "text/javascript" src="js/filmsScript.js"></script>

</head>

<body>

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
$planets = $open_review_s_db->query("SELECT planetID, planet_name, image_url FROM planet");
while($row = $planets->fetch(PDO::FETCH_ASSOC)) {
    ?> <a href='planetInfo.php?id=<?php echo $row['planetID']; ?>' class="cast-item"> <?php
    $img = explode('/revision',$row['image_url']);
    if ($img[0] != NULL){
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
    } else {
        echo "<img class='cast-image' height='100' src='img/noimage.png' alt='film_image'/><br />";
    }
    echo "<p>" . $row['planet_name'] . "</p>";
    echo '</a>';
}
echo '</div>'; // Close the planet-container div

$open_review_s_db = NULL;
?>

</body>
</html>
