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
<!-- Nav Bar Title -->
<div style="text-align: center;">
    <h1>Star Wars Project</h1>
</div>
<div style="text-align: center;">
    <img src="img/logo.png" width="200" alt='film_image'/>
</div>

<!-- Navigation -->
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

<!-- Search -->
<div style="text-align: right;">
    <form>
        <label for="search-bar">Search:</label>
        <input type="text" id="search-bar" />
        <input type="submit">
    </form>
</div>


<h1>Films</h1>

<?php

try {
    $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
    $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

if (!isset($_GET["id"])) {

    try {
        echo '<div class="film-container">';
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, image_url FROM film");
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<a href=films.php?id=" . $row['filmID'] ."> . '<div class=\"film-item\">'";
            echo "<img height='300' src='" . $row['image_url'] . "' alt='film_image' /><br />";
            echo '<div class="film-title">';
            echo "<h2>" . $row['film_title'] . "</h2>";
            echo '</div>';
            echo '</a>';
            echo "</div>";
        }
        echo "</div>";
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    $id = $_GET["id"];
    try {
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, film_opening_crawl, image_url FROM film WHERE filmID = " . $id);
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<h2>" . $row['film_title'] . "</h2>";
            echo '<div class="film-container2">';
            echo "<img height='300' src='" . $row['image_url'] . "' alt='film_image'/><br />";
            echo "</div>";
            echo "<b>Release Date: </b>" . "<p>" . $row['film_release_date'] . "</p>";
            echo "<h2>Film Description:</h2>";
            echo "<p>" . $row['film_opening_crawl'] . "</p>";
            echo "<h2>" . "Databank: " . $row['film_title'] . "<h2>";
        }

        ?>
        <div class="section-buttons">
            <button onclick="showSection('producers', <?php echo $id ?>)">Producers</button>
            <button onclick="showSection('people', <?php echo $id ?>)">People</button>
            <button onclick="showSection('planets', <?php echo $id ?>)">Planets</button>
            <button onclick="showSection('vehicles', <?php echo $id ?>)">Vehicles</button>
            <button onclick="showSection('starships', <?php echo $id ?>)">Starships</button>
        </div>

        <div id="section-content">
            <!-- Content will be loaded here dynamically -->
        </div>
        <?php

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}
?>




</body>
</html>

