<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars - Vehicle Info</title>
    <?php
    include 'headerPage.html';
    ?>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/infoStyle.css">

    <!-- Scripts -->
    <script type = "text/javascript" src="js/filmsScript.js"></script>
</head>

<body>

<?php

require 'classes/Vehicle.php'; // Include the Person class
require 'classes/Manufacturer.php'; // Include the Person class

if (isset($_GET['id'])) {
$id = $_GET['id'];
// Fetch the person's information by ID using your Person class
$vehicle = Vehicle::findById($id);
$manufacturer = Manufacturer::findById($vehicle->getManufacturerID());

?>
<div class='container-fluid padding-above container-color' style='width: 100% height: 100vh' >
    <div class='row py-2 justify-content-center' style='width: 100% height: 100vh'>
        <div class='col-4 px-4'>
            <div class="info-container">
                <img height='300' src='<?php echo $vehicle->getImage(); ?>' alt='vehicle_image' class='info-image' /><br />
                <h2> <?php echo $vehicle->getName() ?> </h2>
            </div>
        </div>

        <div class='col-3 px-4'>
            <div class="info-container">
                <h2>Manufacturer: </h2>
                <?php if ($manufacturer) {?>
                    <h4> <?php echo $manufacturer->getName(); ?> </h4>
                    <img height='200' src='<?php echo $manufacturer->getImg(); ?>' alt='manufacturer_image' class='man-image' /><br />
                <?php } else { ?>
                    <h4> <?php echo "Unknown"; ?> </h4>
                    <img src="img/noimage.png" alt='manufacturer_image' class='man-image' /><br />
                <?php } ?>
            </div>
        </div>

        <div class='col-4 px-4 text-center '>
            <h2> information: </h2>
            <p> <?php echo 'Model: ' . $vehicle->getModel(); ?> </p>
            <p> <?php echo 'Cost: ' . $vehicle->getCost(); ?> </p>
            <p> <?php echo 'Length: ' . $vehicle->getLength(); ?> </p>
            <p> <?php echo 'Max Speed: ' . $vehicle->getMaxSpeed(); ?> </p>
            <p> <?php echo 'Crew Size: ' . $vehicle->getCrew(); ?> </p>
            <p> <?php echo 'Max Passengers: ' . $vehicle->getPassengers(); ?> </p>
            <p> <?php echo 'Cargo Capacity: ' . $vehicle->getCargoCapacity(); ?> </p>
            <p> <?php echo 'Vehicle Consumables: ' . $vehicle->getConsumes(); ?> </p>
            <p> <?php echo 'Class: ' . $vehicle->getVehicleClass(); ?> </p>
        </div>
    </div>
</div>

<div class='row- py-2 justify-content-center' style='width: 100% height: 100vh'>
    <div class='col-12 px-4'>
        <?php
        try {
            $open_review_s_db = new PDO("sqlite:" . '../src/resources/star_wars.db');
            $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $films = $open_review_s_db->query("SELECT * FROM film WHERE filmID IN (SELECT filmID FROM film_vehicles WHERE vehicleID = ". $id . ")");
            $countQuery = $open_review_s_db->query("SELECT count(*) as num FROM film WHERE filmID IN (SELECT filmID FROM film_vehicles WHERE vehicleID = ". $id . ")");
            $count = $countQuery->fetch(PDO::FETCH_ASSOC);
            if ($count['num'] > 0){
                echo '<h2> Vehicle Appears In These Movies:  </h2>';

                echo '<div class="film-container">';
                while($result = $films->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <a href='films.php?id=<?php echo $result['filmID']; ?>' class='film-item'>
                        <img height='300' src='<?php echo $result['image_url']; ?>' alt='film_image' /><br />
                        <div class="film-title">
                            <p class='no-underline'> <?php echo $result['film_title']; ?> </p>
                        </div>
                    </a>
                    <?php
                }
                echo '</div>';
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
        ?>
    </div>
</div>
</div>
<?php } ?>
</body>