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
    try {
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, film_opening_crawl, image_url FROM film WHERE filmID = " . $_GET["id"]);
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<h2>" . $row['film_title'] . "</h2>";
            echo "<a href='films.php?id=" . $row['filmID'] ."'><img height='300' src='" . $row['image_url'] . "' /></a><br />";
            echo "<b>Release Date: </b>" . $row['film_release_date'];
            echo "<h2>Film Description:</h2>";
            echo $row['film_opening_crawl'];
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }


}

?>


<ul>
    <li><a href="films.php">Back</a></li>
</ul>

</body>
</html>

