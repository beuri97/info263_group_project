<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - INFO263</title>
    <script src="js/script.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <!-- CSS libraries -->
    <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/style.css" />


<!--[if gte mso 9]><xml>
<mso:CustomDocumentProperties>
<mso:TaxCatchAll msdt:dt="string">4;#Departmental Document [Information]|fac5df9f-00c6-476f-b378-e7e6fdb4a7a9;#3;#Department Administration|5922f16f-5876-4a9c-b5de-d040ae3368bc;#2;#Business|a8bf67d7-71dc-4e2d-b344-a59a3ab155e8;#1;#Ilam|17015150-e7d5-4990-b358-e90ea571f1b0</mso:TaxCatchAll>
<mso:c2d7d53541144364bb9d71f286b51f7e msdt:dt="string">Ilam|17015150-e7d5-4990-b358-e90ea571f1b0</mso:c2d7d53541144364bb9d71f286b51f7e>
<mso:i7a4717f7d5d4c169373d4bfa77876ba msdt:dt="string">Departmental Document [Information]|fac5df9f-00c6-476f-b378-e7e6fdb4a7a9</mso:i7a4717f7d5d4c169373d4bfa77876ba>
<mso:beaf417fcb4a4faab8ee781c2aab7105 msdt:dt="string"></mso:beaf417fcb4a4faab8ee781c2aab7105>
<mso:SolarDepartment msdt:dt="string">2;#Business|a8bf67d7-71dc-4e2d-b344-a59a3ab155e8</mso:SolarDepartment>
<mso:SolarDocumentType msdt:dt="string">4;#Departmental Document [Information]|fac5df9f-00c6-476f-b378-e7e6fdb4a7a9</mso:SolarDocumentType>
<mso:SolarRecordOutcome msdt:dt="string"></mso:SolarRecordOutcome>
<mso:MediaServiceImageTags msdt:dt="string"></mso:MediaServiceImageTags>
<mso:SolarCategory msdt:dt="string">3;#Department Administration|5922f16f-5876-4a9c-b5de-d040ae3368bc</mso:SolarCategory>
<mso:SolarBusinessUnit msdt:dt="string"></mso:SolarBusinessUnit>
<mso:jb15094b84d04db39a8de0b202a5649b msdt:dt="string"></mso:jb15094b84d04db39a8de0b202a5649b>
<mso:a01561942c7d47699e3a361a6a580934 msdt:dt="string">Business|a8bf67d7-71dc-4e2d-b344-a59a3ab155e8</mso:a01561942c7d47699e3a361a6a580934>
<mso:ece120804c3e4f2e81afd96eec8909f4 msdt:dt="string">Department Administration|5922f16f-5876-4a9c-b5de-d040ae3368bc</mso:ece120804c3e4f2e81afd96eec8909f4>
<mso:InformationValue msdt:dt="string"></mso:InformationValue>
<mso:lcf76f155ced4ddcb4097134ff3c332f msdt:dt="string"></mso:lcf76f155ced4ddcb4097134ff3c332f>
<mso:SolarLocation msdt:dt="string">1;#Ilam|17015150-e7d5-4990-b358-e90ea571f1b0</mso:SolarLocation>
<mso:b0b6db7483f14678a4ad7fdce99521be msdt:dt="string"></mso:b0b6db7483f14678a4ad7fdce99521be>
</mso:CustomDocumentProperties>
</xml><![endif]-->
</head>
<body>

<!-- Header Page -->
<?php include 'headerPage.html';?>


<!-- Home Page Content -->
<img src="img/yoda.jpeg" width="500" alt="Do. Or do not. There is no try."/>
<p>Yoda: "Do. Or do not. There is no try."</p>

<section class="hero">
    <div class="hero-content">
        <!-- Page Style -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
        <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
        <link rel="stylesheet" href="css/filmsStyle.css">

        <!-- Scripts -->
        <script type = "text/javascript" src="js/filmsScript.js"></script>

        <?php
        try {
            $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if (!isset($_GET["id"])) {

            try {
                echo '<h2>Films</h2>';
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
<a href="films.php" class="btn">See All</a>
    </div>
</section>

<section class="hero">
    <div class="hero-content">
        <!-- Page Style -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
        <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
        <link rel="stylesheet" href="css/filmsStyle.css">

        <!-- Scripts -->
        <script type = "text/javascript" src="js/filmsScript.js"></script>
        </head>

        <body>

        <h2>People</h2>

        <?php

        try {
            $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        // Wrap the cast images and names in a container div
        echo '<div class="cast-container">';
        $cast = $open_review_s_db->query("SELECT peopleID, people_name, image_url FROM people");
        while($row = $cast->fetch(PDO::FETCH_ASSOC)) {
        ?> <a href='peopleinfo.php?id=<?php echo $row['peopleID']; ?>' class="cast-item"> <?php
            $img = explode('/revision',$row['image_url']);
            echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
            echo "<p>" . $row['people_name'] . "</p>";
            echo '</a>';
            }
            echo '</div>'; // Close the cast-container div

            ?>

            <a href="people.php" class="btn">See All</a>
    </div>
</section>


<section class="hero">
    <div class="hero-content">

        <!-- Page Style -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
        <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
        <link rel="stylesheet" href="css/filmsStyle.css">

        <!-- Scripts -->
        <script type = "text/javascript" src="js/filmsScript.js"></script>

        </head>

        <body>

        <h2>Planets</h2>

        <?php


        try {
            $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        // Wrap the planet images and names in a container div
        echo '<div class="cast-container">';
        $planets = $open_review_s_db->query("SELECT planetID, planet_name, image_url FROM planet");
        while($row = $planets->fetch(PDO::FETCH_ASSOC)) {
        ?> <a href='planetInfo.php?id=<?php echo $row['planetID']; ?>' class="cast-item"> <?php
            $img = explode('/revision',$row['image_url']);
            echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='planet_image'/><br />";
            echo "<p>" . $row['planet_name'] . "</p>";
            echo '</a>';
            }
            echo '</div>'; // Close the planet-container div
            ?>
        <a href="planets.php" class="btn">See All</a>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; INFO260 GROUP 2 STAR WARS PROJECT</p>
</footer>

</body>
</html>