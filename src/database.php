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


    function addFilm($title, $episode, $crawl, $director, $release, $url) {

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
        $directorID = $db->query("SELECT producerID FROM producer WHERE producer_name = '$director'")->fetch(PDO::FETCH_ASSOC);
        $id = NULL;
        if($directorID == '' or $directorID == NULL) {
            $id = ($db->query("SELECT max(producerID) as num from producer") ->fetch(PDO::FETCH_ASSOC)) + 1;
            $db->query("INSERT INTO PRODUCER VALUES ('$id', '$directorID', NULL)");
        }

        // Add tuple of film_producer after create tuples in film
        $db->query("INSERT INTO film_producer VALUES ('$id', '$number', NULL)");

        $db = null;
    }
?>