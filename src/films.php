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


if (!isset($_GET["id"])) {
    try {
        $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
        $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    try {
        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, image_url FROM film");
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo $row['film_title'] . "<br />";
            echo "<a href='films.php?id=" . $row['filmID'] ."'><img height='300' src='" . $row['image_url'] . "' /></a><br />";
            echo $row['film_release_date'] . "<br /><br />";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
} else {



}

?>

</body>
</html>

