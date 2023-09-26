<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Films</title>
</head>
<body>


<!-- Navigation -->
<nav>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="films.php">Films</a></li>
        <li><a href="planets.php">Planets</a></li>
        <li><a href="people.php">People</a></li>
    </ul>
</nav>

<!-- Search -->
<form>
    <label for="search-bar">Search:</label>
    <input type="text" id="search-bar" />
    <input type="submit">
</form>


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
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, image_url FROM film");
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<h2>" . $row['film_title'] . "</h2>";
            echo "<a href='films.php?id=" . $row['filmID'] ."'><img height='300' src='" . $row['image_url'] . "' /></a><br />";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {
    $id = $_GET["id"];
    try {
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, film_opening_crawl, image_url FROM film WHERE filmID = " . $id);
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<h2>" . $row['film_title'] . "</h2>";
            echo "<a href='films.php?id=" . $row['filmID'] ."'><img height='300' src='" . $row['image_url'] . "' /></a><br />";
            echo "<b>Release Date: </b>" . "<p>" . $row['film_release_date'] . "</p>";
            echo "<h2>Film Description:</h2>";
            echo "<p>" . $row['film_opening_crawl'] . "</p>";
            echo "<h2>" . "Databank: " . $row['film_title'] . "<h2>";
        }

        //TODO: ADD FUNCTIONALITY FOR OTHER TABLES IN FILM WITHIN A TABLE WITH SELECTABLE TABS USING GET. PRODUCER BELOW IS AN EXAMPLE OF A SINGLE TAB:
        echo "<h4>" . "Producers: " . "</h4>";
        // Wrap the producer images and names in a container div
        echo '<div class="producer-container">';
        $producers = $open_review_s_db->query("SELECT producerID, producer_name, image_url FROM producer WHERE producerID IN (SELECT producerID FROM film_producer WHERE filmID = $id)");
        while($row = $producers->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="producer-item">';
            echo "<img height='100' src='" . $row['image_url'] . "' /><br />";
            echo "<p>" . $row['producer_name'] . "</p>";
            echo '</div>';
        }
        echo '</div>'; // Close the producer-container div

    } catch (PDOException $e) {
        die($e->getMessage());
    }

}

?>


<ul>
    <li><a href="films.php">Back</a></li>
</ul>

<!-- Add CSS for formatting -->
<style>

    body {
        background-color: #080807;
    }

    h1 {
        font-style: italic;
        color: white;
    }

    h2 {
        font-style: italic;
        color: yellow;
    }

    p, a, b, h4, text {
        color: white;
    }

    .producer-container {
        display: flex; /* Display items in a row */
        justify-content: space-between; /* Add space between items */
        align-items: center; /* Vertically align items */
        flex-wrap: wrap; /* Wrap items to the next row if necessary */
        justify-content: flex-start;
    }

    .producer-item {
        text-align: center; /* Center-align items */
        margin: 10px; /* Add spacing around each item */
        border: 1px solid #ccc; /* Add a border to each item */
        padding: 10px; /* Add padding to each item */
        width: 200px; /* Limit the width of each item */
    }
</style>

</body>
</html>

