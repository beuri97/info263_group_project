<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>

    <?php

    include 'headerPage.html';
    require_once 'resources/database.php';

    ?>
    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">
</head>

<style>
    td {
        text-align: center;
        font-family: Arial;
        font-weight: bold;
        border: 1px white solid;
    }
    input[type="text"] {
        width: 100%;
        box-sizing: border-box;
    }
    textarea {
        width: 100%;
        box-sizing: border-box;
    }
    input[type="date"] {
        width: 100%;
        box-sizing: border-box;
        text-align: center;
    }
    table{
        width: 73%;
        border: 3px white solid;

    }

    th {
        border: 1px white solid;
    }
    div[id="Add_data_film"] {
        margin-left: 3%;
    }

    div[id="add"] {
        margin-right: auto;
        margin-left: auto;
        width: 70%;
        overflow-y: scroll;
        height: 600px;
        border: 1px khaki solid;
    }
    .center {
        margin-left: 12%;
        margin-right: auto;
    }

    h2.subtitle {
        text-align: left;
        margin-left: 17.5%;
    }
</style>

<body>
<br>
<br>
<h2>Add Film</h2>
<br>
<br>
<form action="form.php" method="post">
    <h2 class="subtitle">FILM INFO</h2>
    <div id = "Add_data_film">
        <table class="center">
            <tr>
                <td><label for="input-title">Title</label></td>
                <td id="td-title"><input id = "input-title" type="text" name = "title" required></td>
                <td><label for="input-episode">Episode</label></td>
                <td colspan="3" id="td-episode"><input type="text" id="input-episode" name="episode" required></td>
                <td><label for="input-director">Director</label></td>
                <td id="td-director"><input type="text" id="input-director" name="director" required></td>
                <td><label for="input-date">Date</label></td>
                <td id="td-date"><input type="date" id="input-date" name="release_date" required></td>
            </tr>
            <tr>
                <td><label for="input-crawl">Opening Crawl</label></td>
                <td colspan="9" id="td-crawl"><textarea id="input-crawl" style="resize: none" rows="10" name="crawl" required>Enter text here.</textarea> </td>
            </tr>
            <tr>
                <td><label for="input-url">image URL</label></td>
                <td colspan="9"><input type="text" id="input-url" name="url"></td>
            </tr>
        </table>
    </div>
    <br>
    <h2 class="subtitle">PEOPLE</h2>
    <div id="add" class="cast-container">
        <?php getData("SELECT peopleID, people_name, image_url FROM PEOPLE", "people");?>
    </div>
    <br />
    <h2 class="subtitle">PLANET</h2>
    <div id="add" class="cast-container">
        <?php getData("SELECT planetID, planet_name, image_url FROM PLANET", "planet");?>
    </div>
    <br />
    <h2 class="subtitle">VEHICLE</h2>
    <div id="add" class="cast-container">
        <?php getData("SELECT vehicleID, vehicle_name, image_url FROM VEHICLE", "vehicle");?>
    </div>
    <h2 class="subtitle">STAR SHIP</h2>
    <div id="add" class="cast-container">
        <?php getData("SELECT starshipID, starship_name, image_url FROM STARSHIP", "starship");?>
    </div>
    <input type="submit" id="submit" name="add" value="Add" style="margin-left: 15%">
</form>
<br>

<script>
    function selected(element) {
        var currentColor = getComputedStyle(element).background;
        console.log(currentColor);
        var getDataType = element.id.split("-");
        if(currentColor === "rgb(16, 11, 11)") {
            element.style.background = "#f1fc88";
        } else {
            element.style.background = "#100b0b";
        }
    }
</script>


<?php
// Initialise films attributes' values
if(isset($_POST['add'], $_POST['title'], $_POST['episode'], $_POST['director'], $_POST['release_date'], $_POST['crawl'], $_POST['add']))
{
    $title = $_POST['title'];
    $episode = (int)$_POST['episode'];
    $director = $_POST['director'];
    $release = date("Y-m-d", strtotime($_POST['release_date']));
    $crawl = $_POST['crawl'];
}

if(isset($_POST['add'], $title, $episode, $director, $release, $crawl) and $title != '' and $episode != '' and $director != ''
    and $release != '' and $crawl != '') {
    $url = ($_POST['url'] == '') ? NULL : $_POST['url'];
    addFilm($title, $episode, $crawl, $director, $release, $url);
}

function getData($query, $name) {
    $db = openConnection();
    $cast = retrieveQuery($db, $query);
    $id = $name  ."ID";
    while($row=$cast->fetch(PDO::FETCH_ASSOC)) {
        echo "<div id='{$name}-{$row[$id]}' class='cast-item' onclick='selected(this)'>";
        $img = explode('/revision',$row['image_url']);
        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
        echo "<p>" . $row[$name.'_name'] . "</p>";
        echo "</div>";
    }
    closeConnection($db);
}
?>
</body>
</html>


