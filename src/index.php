<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <title>Star Wars Data - INFO263</title>
    <meta name="description" content="Unleash the Force of Star Wars data! Explore characters, ships, planets,
    and more in the ultimate Star Wars database. May the data be with you.">
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

<style>
    .search-form .form-control {
        height: 35px; /* Adjust the height as needed */
        width: 150px;
        padding: 5px;  /* Adjust the padding as needed */
    }
</style>

<!-- Header Page -->
<?php include 'headerPage.html';?>


<!-- Home Page Content -->
<div style="text-align: center; padding: 50px; background: #2e2d2f; color: yellow">
    <img src="img/yoda.jpeg" width="500" alt="Do. Or do not. There is no try."/>
    <h3>Yoda: "Your path you must decide."</h3>
    <section class="container">
        <form action="search.php" method="post" class="search-form" style="align-content: center">
            <div class="input-group" style="max-width: 750px; margin: 0 auto; padding-top: 20px">
                <input type="text" class="form-control" name="query" placeholder="Search the force">
            </div>
            <div class="input-group" style="max-width: 100px; margin: 0 auto; align-content: center">
                <button class="btn btn-primary" type="submit" style="margin-top: 5px;">Search</button>
            </div>
        </form>
    </section>
</div>

<!-- Page Style -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
<link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
<link rel="stylesheet" href="css/filmsStyle.css">

<!-- Slide shows for page types -->
<div class='container' >
    <div class='row py-2 justify-content-center'>
        <b style="text-align:center; font-size: xx-large">EXPLORE:</b>
        <section class="hero" style="padding: 40px;">
            <div class="hero-content">
                <h2>Films</h2>
                <div id="filmCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        try {
                        $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
                        $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $res = $open_review_s_db->query("SELECT filmID, film_title, film_release_date, image_url FROM film");
                        $first = true;
                        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
                        if ($first) {
                            echo '<div class="carousel-item active">';
                            $first = false;
                        } else {
                            echo '<div class="carousel-item">';
                        }
                        ?>
                        <a href='films.php?id=<?php echo $row['filmID']; ?>'>
                            <img src='<?php echo $row['image_url']; ?>' alt='film_image' class='film_image' height='600'>
                        </a>

                    </div>
                    <?php
                    }
                    } catch (PDOException $e) {
                        die($e->getMessage());
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#filmCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#filmCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <a href="films.php" class="btn">See All</a>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </section>
    </div>

    <div class='row py-2 justify-content-center'>
        <div class="col-5">
            <section class="hero" style="padding: 10px; background: #333333;">
                <div class="hero-content">
                    <div class="container">
                        <h2>People</h2>
                        <div id="peopleCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                try {
                                $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
                                $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $cast = $open_review_s_db->query("SELECT peopleID, people_name, image_url FROM people");
                                $first = true;
                                while($row = $cast->fetch(PDO::FETCH_ASSOC)) {
                                if ($first) {
                                    echo '<div class="carousel-item active">';
                                    $first = false;
                                } else {
                                    echo '<div class="carousel-item">';
                                }
                                ?>
                                <a href='peopleinfo.php?id=<?php echo $row['peopleID']; ?>'> <?php
                                    $img = explode('/revision',$row['image_url']);
                                    if ($img[0] != NULL){
                                        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='film_image'/><br />";
                                    }
                                    echo "<p>" . $row['people_name'] . "</p>";
                                    echo '</a>';
                                    ?>
                            </div>
                            <?php
                            }
                            } catch (PDOException $e) {
                                die($e->getMessage());
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#peopleCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#peopleCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <a href="people.php" class="btn">See All</a>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </section>
        </div>

        <div class="col-5">
            <section class="hero" style="padding: 10px; background: #333333;">
                <div class="hero-content">
                    <div class="container">
                        <h2>Planets</h2>
                        <div id="planetsCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                try {
                                $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
                                $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $planets = $open_review_s_db->query("SELECT planetID, planet_name, image_url FROM planet");
                                $first = true;
                                while($row = $planets->fetch(PDO::FETCH_ASSOC)) {
                                if ($first) {
                                    echo '<div class="carousel-item active">';
                                    $first = false;
                                } else {
                                    echo '<div class="carousel-item">';
                                }
                                ?> <a href='planetInfo.php?id=<?php echo $row['planetID']; ?>'> <?php
                                    $img = explode('/revision',$row['image_url']);
                                    if ($img[0] != NULL){
                                        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='planet_image'/><br />";
                                    }
                                    echo "<p>" . $row['planet_name'] . "</p>";
                                    echo '</a>';
                                    ?>
                            </div>
                            <?php
                            }
                            } catch (PDOException $e) {
                                die($e->getMessage());
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#planetsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#planetsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <a href="planets.php" class="btn">See All</a>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </section>
        </div>
    </div>

    <div class='row py-2 justify-content-center' >
        <div class="col-5">
            <section class="hero" style="padding: 10px; background: #333333;">
                <div class="hero-content">
                    <div class="container">
                        <h2>Vehicles</h2>
                        <div id="vehicleCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                try {
                                $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
                                $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $vehicles = $open_review_s_db->query("SELECT vehicleID, vehicle_name, image_url FROM vehicle");
                                $first = true;
                                while($row = $vehicles->fetch(PDO::FETCH_ASSOC)) {
                                if ($first) {
                                    echo '<div class="carousel-item active">';
                                    $first = false;
                                } else {
                                    echo '<div class="carousel-item">';
                                }
                                ?> <a href='vehicleInfo.php?id=<?php echo $row['vehicleID']; ?>' > <?php
                                    $img = explode('/revision',$row['image_url']);
                                    if ($img[0] != NULL){
                                        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='vehicle_image'/><br />";
                                    }
                                    echo "<p>" . $row['vehicle_name'] . "</p>";
                                    echo '</a>';
                                    ?>
                            </div>
                            <?php
                            }
                            } catch (PDOException $e) {
                                die($e->getMessage());
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#vehicleCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#vehicleCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <a href="vehicles.php" class="btn">See All</a>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </section>
        </div>

        <div class="col-5">
            <section class="hero" style="padding: 10px; background: #333333;">
                <div class="hero-content">
                    <div class="container">
                        <h2>Starships</h2>
                        <div id="starshipCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                try {
                                $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
                                $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $starships = $open_review_s_db->query("SELECT starshipID, starship_name, image_url FROM starship");
                                $first = true;
                                while($row = $starships->fetch(PDO::FETCH_ASSOC)) {
                                if ($first) {
                                    echo '<div class="carousel-item active">';
                                    $first = false;
                                } else {
                                    echo '<div class="carousel-item">';
                                }
                                ?> <a href='starshipInfo.php?id=<?php echo $row['starshipID']; ?>' > <?php
                                    $img = explode('/revision',$row['image_url']);
                                    if ($img[0] != NULL){
                                        echo "<img class='cast-image' height='100' src='" . $img[0] . "' alt='starship_image'/><br />";
                                    }
                                    echo "<p>" . $row['starship_name'] . "</p>";
                                    echo '</a>';
                                    ?>
                            </div>
                            <?php
                            }
                            } catch (PDOException $e) {
                                die($e->getMessage());
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#starshipCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#starshipCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <a href="starships.php" class="btn">See All</a>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </section>
        </div>
    </div>
</div>




<!-- Footer -->
<footer>
    <p>&copy; INFO260 GROUP 2 STAR WARS PROJECT</p>
</footer>

</body>
</html>