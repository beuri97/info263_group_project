<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars - Planet Info</title>
    <?php
    include 'headerPage.html';
    ?>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/infoStyle.css">

    <!-- Scripts -->
    <script type = "text/javascript" src="js/filmsScript.js"></script>
</head>

<body>

<?php

require 'classes/Planet.php'; // Include the Person class

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the person's information by ID using your Person class
    $planet = Planet::findById($id);

    ?>
    <div class='container-fluid padding-above container-color' style='width: 100% height: 100vh' >
        <div class='row py-2 justify-content-center' style='width: 100% height: 100vh'>
            <div class='col-3 px-4'>
                <div class="info-container">
                    <img height='300' src='<?php echo $planet->getImage(); ?>' alt='planet_image' class='plan-image' /><br />
                    <h2> <?php echo $planet->getName() ?> </h2>
                </div>
            </div>

            <div class='col-3 px-4 text-center '>
                <h2> information: </h2>
                <p> <?php echo 'Rotation: ' . $planet->getRotation(); ?> </p>
                <p> <?php echo 'Orbit: ' . $planet->getOrbit(); ?> </p>
                <p> <?php echo 'Diameter: ' . $planet->getDiameter(); ?> </p>
                <p> <?php echo 'Diameter: ' . $planet->getGravity(); ?> </p>
                <p> <?php echo 'Surface Water: ' . $planet->getWater(); ?> </p>
                <p> <?php echo 'Population: ' . $planet->getPopulation(); ?> </p>
                <p> <?php echo 'Climate: ' . $planet->getClimate(); ?> </p>
                <p> <?php echo 'Terrain: ' . $planet->getTerrain(); ?> </p>
            </div>
        </div>
    </div>
    <div class='row- py-2 justify-content-center' style='width: 100% height: 100vh'>
        <div class='col-12 px-4'>
            <?php
            try {
                $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
                $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $films = $open_review_s_db->query("SELECT * FROM film WHERE filmID IN (SELECT filmID FROM film_planet WHERE planetID = ". $id . ")");
                $countQuery = $open_review_s_db->query("SELECT count(*) as num FROM film WHERE filmID IN (SELECT filmID FROM film_planet WHERE planetID = ". $id . ")");
                $count = $countQuery->fetch(PDO::FETCH_ASSOC);
                if ($count['num'] > 0){
                    echo '<h4> Movies:  </h4>';

                    echo '<div class="film-container">';
                    while($result = $films->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <a href='films.php?id=<?php echo $result['filmID']; ?>' class='film-item'>
                            <img height='300' src='<?php echo $result['image_url']; ?>' alt='film_image' /><br />
                            <div class="film-title">
                                <p class='no-underline'> <?php echo $result['film_title']; ?> </p>
                            </div>
                        </a>
                        <?php
                    }
                    echo '</div>';
                }

            } catch (PDOException $e) {
                die($e->getMessage());
            }
            ?>
        </div>
    </div>
    </div>

<?php } ?>
</body>

