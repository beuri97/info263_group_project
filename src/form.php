<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>

    <?php

    include 'headerPage.html';
    require_once 'resources/database.php';
    session_start();
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
<br>
<br>
<h2 id="confirm"></h2>
<br>
<input type="submit" id="submit" name="add" value="FILM SAVE" style="margin-left: 47%" onclick="process()">


<script>
    var people = [];
    var planet = [];
    var vehicle = [];
    var starShip = [];

    function arrayHandling(name, id, add) {

        var index = -1;
        switch (name) {
            case "people":
                if(add) {
                    people.push(id);
                } else {
                    index = people.indexOf(id);
                    people.splice(index);
                }
                break;
            case "planet":
                if(add) {
                    planet.push(id);
                } else {
                    index = planet.indexOf(id);
                    planet.splice(index);
                }
                break;
            case "vehicle":
                if(add) {
                    vehicle.push(id);
                } else {
                    index = vehicle.indexOf(id);
                    vehicle.splice(index);
                }
                break;
            case "starship":
                if(add) {
                    starShip.push(id);
                } else {
                    index = starShip.indexOf(id);
                    starShip.splice(index);
                }
                break;

        }
    }

    function selected(element) {
        var currentColor = getComputedStyle(element).backgroundColor;
        console.log(currentColor);
        var getDataType = element.id.split("-");
        if(currentColor === "rgb(16, 11, 11)") {
            element.style.background = "#f1fc88";
            arrayHandling(getDataType[0], getDataType[1], true);
        } else {
            element.style.background = "#100b0b";
            arrayHandling(getDataType[0], getDataType[1], false);
        }
    }

    function process() {
        let username = null;
        fetch('getUsername.php')
            .then(response => response.json())
            .then(data => {
                username = data.username;
                console.log(username);
                if (username === null || username === "") {
                    document.getElementById('confirm').innerHTML = "PLEASE LOG IN FRIST";
                } else {
                    var title = document.getElementById('input-title').value;
                    var episode = document.getElementById('input-episode').value;
                    var director = document.getElementById('input-director').value;
                    var release = document.getElementById('input-date').value;
                    var crawl = document.getElementById('input-crawl').value;
                    var url = (document.getElementById('input-url').value === "") ? null : document.getElementById('input-url').value;

                    var data = [title, episode, director, release, crawl, url, people, planet, vehicle, starShip];

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "form.php", true);
                    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Request Done!
                            console.log(xhr.responseText);
                        } else {
                            console.error("FAILED:", xhr.status);
                            console.error(xhr.statusText);
                        }
                    };

                    xhr.send(JSON.stringify(data));

                    document.getElementById('confirm').innerHTML = "FILM SAVED SUCCESS";
                }
            })




    }
</script>


<?php
//$people = null;
//$planet = null;
//$vehicle = null;
//$starShip = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $dataArray = json_decode($data);
    echo var_dump($dataArray) . $dataArray . "<br />";

    //update FILM data
    $id = getNewFilmID();
    $title = $dataArray[0];
    $episode = (int)$dataArray[1];
    $director = $dataArray[2];
    $release = $dataArray[3];
    $crawl = $dataArray[4];
    $url = $dataArray[5];
    addFilm($id, $title, $episode, $crawl, $director, $release, $url);

    // People updates from the new film
    $people = $dataArray[6];
    peopleFilmUpdate($id, $people);

    // Planet updates from the new film
    $planet = $dataArray[7];
    updateFilmPlanet($id, $planet);

    // Vehicle updates from the new film
    $vehicle = $dataArray[8];
    updateFilmVehicle($id, $vehicle);

    // Starship updates from the new film
    $starShip = $dataArray[9];
    updateFilmStarShip($id, $starShip);


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
