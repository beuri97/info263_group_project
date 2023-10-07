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

<?php

try {
    $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
    $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

if (!isset($_GET["id"])) {

    try {
        echo '<h1>Films</h1>';
        echo '<div class="film-container">';
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, image_url FROM film");
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <a href='films.php?id=<?php echo $row['filmID']; ?>' class='film-item'>
                    <img height='300' src='<?php echo $row['image_url']; ?>' alt='film_image' /><br />
                    <div class="film-title">
                        <h2 class='no-underline'> <?php echo $row['film_title']; ?> </h2>
                    </div>
                </a>

            <?php
        }
        echo '</div>';
    } catch (PDOException $e) {
        die($e->getMessage());
    }

} else {
    $id = $_GET["id"];
    try {
        echo "<div class='container-fluid padding-above'>";
        echo "<div class='row py-2 justify-content-center'>";
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, film_opening_crawl, image_url FROM film WHERE filmID = " . $id);
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class='col-4 px-4'>
                <div class="film-container2">
                    <h2> <?php echo $row['film_title']; ?> </h2>
                    <img height='300' src='<?php echo $row['image_url']; ?>' alt='film_image' /><br />
                    <b>Release Date: </b>
                    <p><?php echo$row['film_release_date']; ?></p>
                    <h2>Film Description:</h2>
                    <p class="desc"><?php echo$row['film_opening_crawl']; ?></p>
                </div>
            </div>
            <div class='col-8 px-4 text-center '>
                <h2> Databank: <?php echo $row['film_title']; ?></h2>

        <?php } ?>

                <div class="section-buttons">
                    <button onclick="showSection('producers', <?php echo $id ?>)">Producers</button>
                    <button onclick="showSection('cast', <?php echo $id ?>)">People</button>
                    <button onclick="showSection('planets', <?php echo $id ?>)">Planets</button>
                    <button onclick="showSection('vehicles', <?php echo $id ?>)">Vehicles</button>
                    <button onclick="showSection('starships', <?php echo $id ?>)">Starships</button>
                </div>

                <div id="section-content">
                    <!-- Content will be loaded here dynamically -->
                </div>
            </div>

        <?php
        echo "</div>";
        echo "</div>";

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>




</body>
</html>

