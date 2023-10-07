<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Films</title>

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


<?php

require 'classes/Person.php'; // Include the Person class

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the person's information by ID using your Person class
    $person = Person::findById($id);

    $planetId = $person->getHomeWorldId();
?>
<div class='container-fluid padding-above container-color' >
    <div class='row py-2 justify-content-center'>
            <div class='col-6 px-4'>
                <div class="info-container">
                    <img height='300' src='<?php echo $person->getImage(); ?>' alt='cast_image' class='info-image' /><br />
                    <h2> <?php echo $person->getName() ?> </h2>
                </div>
            </div>

            <div class='col-6 px-4 text-center '>
                <h2> information: </h2>
                <p> <?php echo 'Species: ' . $person->getSpecies(); ?> </p>
                <p> <?php echo $person->getGender() . ', ' . $person->getMass() . ', born in ' . $person->getBirth(); ?> </p>
                <p> <?php echo $person->getHairColor() . ', ' . $person->getSkinColor() . ', ' . $person->getEyeColor(); ?> </p>
                <h4> Home World:  </h4>
                <div class="people-container">
                <a href='planetInfo.php?id=<?php echo $planetId; ?>' class='people-item'>
                    <img height='100' src='<?php echo $person->getPlanetImage($planetId); ?>' alt='planet-image' /><br />
                    <p> <?php echo $person->getHomeWorld(); ?> </p>
                </a>
                </div>
            </div>
        </div>
    </div>
    <div class='row- py-2 justify-content-center'>
        <div class='col-12 px-4'>
            <h4> Movies:  </h4>
            <?php
            try {
                $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
                $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo '<div class="film-container">';
                $films = $open_review_s_db->query("SELECT * FROM film WHERE filmID IN (SELECT filmID FROM film_people WHERE peopleID = ". $id . ")");
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

            } catch (PDOException $e) {
                die($e->getMessage());
            }
            ?>
        </div>
    </div>
</div>

<?php } ?>
</body>
</html>