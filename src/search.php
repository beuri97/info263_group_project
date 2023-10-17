<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Search</title>
    <meta name="description" content="Explore the entire Star Wars universe with our site search.
    Find characters, ships, planets, and more. Search the galaxy of Star Wars with knowledge at your fingertips.">
    <?php
    include 'headerPage.html';
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Filter And Search</title>
    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">

</head>
<?php
if (isset($_POST['query'])) {
    echo "<h3 style='text-align: center; padding-top: 40px' > SEARCH FOR: " . $_POST['query'] . "</h3>";
}
    ?>

<section class="container" >
    <form action="search.php" method="post" class="search-form" style="align-content: center">
        <div class="input-group" style="max-width: 750px; margin: 0 auto; padding-top: 20px">
            <input type="text" class="form-control" name="query" placeholder="Search the force">
        </div>
        <div class="input-group" style="padding-bottom: 20px; max-width: 100px; margin: 0 auto; align-content: center">
            <button class="btn btn-primary" type="submit" style="margin-top: 5px;" >Search</button>
        </div>
    </form>
</section>
<?php
// Require classes
require 'classes/Person.php';
require 'classes/Planet.php';
require 'classes/Vehicle.php';
require 'classes/Starships.php';

if (isset($_POST['query'])) {
    $search_query = $_POST['query'];

    // Call person in PHP class to search for results
    $personResults = Person::searchPeople($search_query);
    // Display the person results
    echo '<h2 style="padding: 20px">People:</h2>';
    echo '<div class="cast-container" style="justify-content: center; width: 100%; background: #333333" >';
    if (empty($personResults)) {
        echo "<h3 style='text-align: center;' >" . "No results found" . "</h3>";
    } else {

        foreach ($personResults as $result) { ?>
            <a href='peopleInfo.php?id=<?php echo $result->getId(); ?>' class="cast-item">
                <img class='cast-image' height='150' src='<?php echo $result->getImage(); ?>' alt='(Missing) Image Of:' /><br />
                <p> <?php echo $result->getName() ?> </p>
            </a>
            <?php
        }
    }
    echo '</div>'; // Close the cast-container div

    // Call planet in PHP class to search for results
    $planetResults = Planet::searchPlanet($search_query);
    // Display the planet results
    echo '<h2 style="padding: 20px">Planets:</h2>';
    echo '<div class="cast-container" style="justify-content: center; width: 100%; background: #333333">';
    if (empty($planetResults)) {
        echo "<h3 style='text-align: center;' >" . "No results found" . "</h3>";
    } else {
        foreach ($planetResults as $result) { ?>
            <a href='planetInfo.php?id=<?php echo $result->getId(); ?>' class="cast-item">
                <img class='cast-image' height='150' src='<?php echo $result->getImage(); ?>' alt='(Missing) Image Of:' /><br />
                <p> <?php echo $result->getName() ?> </p>
            </a>
            <?php
        }
    }
    echo '</div>'; // Close the vehicle-container div

    // Call vehicle in PHP class to search for results
    $vehicleResults = Vehicle::searchVehicle($search_query);
    // Display the vehicle results
    echo '<h2 style="padding: 20px">Vehicles:</h2>';
    echo '<div class="cast-container" style="justify-content: center; width: 100%; background: #333333">';
    if (empty($vehicleResults)) {
        echo "<h3 style='text-align: center;' >" . "No results found" . "</h3>";
    } else {
        foreach ($vehicleResults as $result) { ?>
            <a href='vehicleInfo.php?id=<?php echo $result->getId(); ?>' class="cast-item">
                <img class='cast-image' height='150' src='<?php echo $result->getImage(); ?>' alt='(Missing) Image Of:' /><br />
                <p> <?php echo $result->getName() ?> </p>
            </a>
            <?php
        }
    }
    echo '</div>'; // Close the vehicle-container div

    // Call starship in PHP class to search for results
    $starshipResults = Starships::searchStarship($search_query);
    // Display the starship results
    echo '<h2 style="padding: 20px">Starships:</h2>';
    echo '<div class="cast-container" style="justify-content: center; width: 100%; background: #333333">';
    if (empty($starshipResults)) {
        echo "<h3 style='text-align: center;' >" . "No results found" . "</h3>";
    } else {
        foreach ($starshipResults as $result) { ?>
            <a href='starshipInfo.php?id=<?php echo $result->getId(); ?>' class="cast-item">
                <img class='cast-image' height='150' src='<?php echo $result->getImage(); ?>' alt='(Missing) Image Of:' /><br />
                <p> <?php echo $result->getName() ?> </p>
            </a>
            <?php
        }
    }
    echo '</div>'; // Close the starship-container div
}
?>


</body>
</html>