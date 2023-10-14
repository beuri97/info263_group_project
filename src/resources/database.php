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