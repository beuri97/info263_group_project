<?php

    function openConnection() {
        try {
            $db = new PDO("sqlite:resources/star_wars.db");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $db;
    }

    function closeConnection(&$db) {
        $db = null;
    }

    function getNewFilmID() {
        $db = openConnection();
        // create filmID
        $result = $db->query("SELECT max(filmID) as num from film");
        $resultNum = $result->fetch(PDO::FETCH_ASSOC);
        $number = (int)($resultNum['num'] + 1);
        $db = null;

        return $number;
    }
    function addFilm($id, $title, $episode, $crawl, $director, $release, $url) {

        $db = openConnection();
        // create filmID
        $result = $db->query("SELECT max(filmID) as num from film");
        $resultNum = $result->fetch(PDO::FETCH_ASSOC);
        $number = (int)($resultNum['num'] + 1);

        // insert basic film information
        $query = "INSERT INTO film(filmID, film_title, film_episode_id, film_opening_crawl, film_director, film_release_date, image_url)
                    values('$number', '$title', '$episode', '$crawl', '$director', '$release', '$url')";
        $stmt = $db->prepare($query);
        $stmt->execute();

        // film_producer relation need to be added automatically
        $directorID = (int)($db->query("SELECT producerID FROM producer WHERE producer_name = '$director'")->fetch(PDO::FETCH_ASSOC));
        if($directorID == 0) {
            $directorID = $db->query("SELECT max(producerID) as num from producer")->fetch(PDO::FETCH_ASSOC);
            $directorID = (int)($directorID['num'] + 1);
            $db->query("INSERT INTO PRODUCER VALUES ('$directorID', '$director', NULL)");
        }

        // Add tuple of film_producer after create tuples in film
        $db->query("INSERT INTO film_producer VALUES ('$directorID', '$number', NULL)");

        $db = null;
    }

    function peopleFilmUpdate($id, $datas) {

        $db = openConnection();
        for($i =0; $i<count($datas); $i++) {
            $peopleID = $datas[$i];
            $query = "INSERT INTO film_people VALUES ('$peopleID', '$id', null)";
            $db->query($query);
            $species = $db->query("SELECT people_species_id as species from people WHERE peopleID = '$id'")->fetch(PDO::FETCH_ASSOC);
            $count = $db->query("SELECT count(*) FROM film_species where filmID='$id' and speciesID = '$species'")->fetch(PDO::FETCH_ASSOC);
            if($count == 0) {
                $db->query("INSERT INTO film_species VALUES ('$species', '$id', NULL)");
            }
        }

        closeConnection($db);
    }

    function updateFilmPlanet($id, $datas) {

        $db = openConnection();
        for($i =0; $i<count($datas); $i++) {
            $planetID = $datas[$i];
            $db->query("INSERT INTO film_planet VALUES ('$planetID', '$id', null)");
        }
        closeConnection($db);
    }

    function updateFilmVehicle($id, $datas) {

        $db = openConnection();
        for($i =0; $i<count($datas); $i++) {
            $vehicleID = $datas[$i];
            $db->query("INSERT INTO film_vehicles VALUES ('$vehicleID', '$id', null)");
        }

        closeConnection($db);

    }
    function updateFilmStarShip($id, $datas) {

        $db = openConnection();
        for($i =0; $i<count($datas); $i++) {
            $starShipID = $datas[$i];
            $db->query("INSERT INTO film_starships VALUES ('$starShipID', '$id', null)");
        }

        closeConnection($db);

    }

    function addUser($name, $email, $password): void
    {

        $db = openConnection();

        // insert basic user information
        $query = "INSERT INTO registered_users(username, email, password_hash)
                        values('$name', '$email', '$password')";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $db = null;
    }

    function uniqueEmail($email): string
    {

        $db = openConnection();

        // check if other query exists
        $query = "SELECT count(*) as num FROM registered_users WHERE email = '$email'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user['num'] > 0){
            return "Email in use, try logging in";
        } else {
            return '';
        }
        $db = null;
    }

    function retrieveQuery(&$db, $query)
    {
        return $db->query($query);

    }
?>