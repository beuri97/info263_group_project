<?php
// Fetch data for people
require 'classes/Person.php'; // Include the Person class
$personData = [];
$pplCount = Person::peopleCount();
for ($i = 1; $i <= $pplCount; $i++) {
    $person = Person::findById($i);
    if ($person) {
        $personData[] = [
            'name' => $person->getName(),
            'height' => $person->getHeight(),
            'eyes' => $person->getEyeColor(),
            'gender' => $person->getGender()
        ];
    }
}

$eyeColorToColor = [
    'blue' => 'blue',
    'green' => 'green',
    'brown' => 'saddlebrown',
    'gray' => 'gray',
    'red' => 'red',
    'green, yellow' => 'greenyellow',
    'yellow' => 'yellow',
    'gold' => 'gold',
    'black' => 'black',
    'white' => 'white',
    'pink' => 'pink',
    'red, blue' => 'rebeccapurple',
    'blue, grey' => 'lightsteelblue',
    'hazel' => 'sandybrown',
    'orange' => 'orange',
    'unknown' => 'darkgrey'
];

// Prepare data for the eyeColor chart
$eyeColorLabels = [];
$eyeColorData = [];
$eyeColorCounts = array_count_values(array_column($personData, 'eyes'));
foreach ($eyeColorCounts  as  $color => $count) {
    $eyeColorLabels[] = $color;
    $eyeColorData[] = $count;
}

// Sort eye color data based on count in descending order
array_multisort($eyeColorData, SORT_DESC, $eyeColorLabels);

// Map eye colors to corresponding colors
$eyeColorColors = array_map(function($eyeColor) use ($eyeColorToColor) {
    return $eyeColorToColor[$eyeColor] ?? 'gray'; // Default to 'gray' for unknown colors
}, $eyeColorLabels);



$genderToColor = [
    'male' => 'blue',
    'female' => 'pink',
    'hermaphrodite' => 'green',
    'n/a' => 'grey',
    'none' => 'black'
];

// Prepare data for the gender chart
$genderLabels = [];
$genderData = [];
$genderCounts = array_count_values(array_column($personData, 'gender'));
foreach ($genderCounts  as  $gender => $count) {
    $genderLabels[] = $gender;
    $genderData[] = $count;
}

// Sort eye gender data based on count in descending order
array_multisort($genderData, SORT_DESC, $genderLabels);

// Map gender to corresponding colors
$genderColors = array_map(function($gender) use ($genderToColor) {
    return $genderToColor[$gender] ?? 'gray'; // Default to 'gray' for unknown colors
}, $genderLabels);


// Fetch data for planets
require 'classes/Planet.php'; // Include the Planet class
$planetsData = [];
$planetCount = Planet::planetCount();
for ($i = 1; $i <= $planetCount; $i++) {
    $planet = Planet::findById($i);
    if ($planet) {
        if (is_numeric($planet->getPopulation())){
            $planetData[] = [
                'name' => $planet->getName(),
                'population' => $planet->getPopulation()
            ];
        } else{
            $planetData[] = [
                'name' => $planet->getName(),
                'population' => 0
            ];
        }

    }
}

// Prepare data for the population chart
usort($planetData, function ($a, $b) {
    return $b['population'] - $a['population'];
});

$topPlanetData = array_slice($planetData, 0, 10); // Get the top 10 populations

$planetLabels = [];
$populationData = [];
foreach ($topPlanetData  as  $planet) {
    $planetLabels[] = $planet['name'];
    $populationData[] = $planet['population'];
}


// Fetch data for vehicles
require 'classes/Vehicle.php'; // Include the Planet class
$vehicleData = [];
$vehicleCount = Vehicle::vehicleCount();
for ($i = 1; $i <= $vehicleCount; $i++) {
    $vehicle = Vehicle::findById($i);
    if ($vehicle) {
        if (is_numeric($vehicle->getMaxSpeed())){
            if (is_numeric($vehicle->getCost())) {
                $vehicleData[] = [
                    'name' => $vehicle->getName(),
                    'speed' => $vehicle->getMaxSpeed(),
                    'cost' => $vehicle->getCost()
                ];
            } else {
                $vehicleData[] = [
                    'name' => $vehicle->getName(),
                    'speed' => $vehicle->getMaxSpeed(),
                    'cost' => 0
                ];
            }
        } else{
            if (is_numeric($vehicle->getCost())) {
                $vehicleData[] = [
                    'name' => $vehicle->getName(),
                    'speed' => 0,
                    'cost' => $vehicle->getCost()
                ];
            } else {
                $vehicleData[] = [
                    'name' => $vehicle->getName(),
                    'speed' => 0,
                    'cost' => 0
                ];
            }
        }

    }
}

// Prepare data for the vehicle speed chart
usort($vehicleData, function ($a, $b) {
    return $b['speed'] - $a['speed'];
});

// Create a new array with the sorted data
$speedVehicleData = $vehicleData;

$topVehicleData = array_slice($speedVehicleData, 0, 10); // Get the top 10 vehicle speeds

$vehicleLabels = [];
$speedData = [];
foreach ($topVehicleData  as  $vehicle) {
    $vehicleLabels[] = $vehicle['name'];
    $speedData[] = $vehicle['speed'];
}

// Prepare data for the vehicle cost chart
usort($vehicleData, function ($a, $b) {
    return $b['cost'] - $a['cost'];
});

// Create a new array with the sorted data
$costVehicleData = $vehicleData;

$topCostVehicleData = array_slice($costVehicleData, 0, 10); // Get the top 10 vehicle speeds

$vehicleCostLabels = [];
$costData = [];
foreach ($topCostVehicleData  as  $vehicle) {
    $vehicleCostLabels[] = $vehicle['name'];
    $costData[] = $vehicle['cost'];
}




// Fetch data for Starships
require 'classes/Starships.php'; // Include the Starships class
$starshipsData = [];
$starshipsCount = Starships::starshipCount();
for ($i = 1; $i <= $starshipsCount; $i++) {
    $starships = Starships::findById($i);
    if ($starships) {
        if (is_numeric($starships->getCrew())){
            $starshipsData[] = [
                'name' => $starships->getName(),
                'crew' => $starships->getCrew()
            ];
        } else {
            $starshipsData[] = [
                'name' => $starships->getName(),
                'crew' => 0
            ];
        }
    }
}

// Prepare data for the Starships chart
usort($starshipsData, function ($a, $b) {
    return $b['crew'] - $a['crew'];
});

$topStarshipData = array_slice($starshipsData, 0, 5); // Get the top 10 populations

$starshipLabels = [];
$starshipData = [];
foreach ($topStarshipData  as  $starship) {
    $starshipLabels[] = $starship['name'];
    $starshipData[] = $starship['crew'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars Charts</title>

    <?php
    include 'headerPage.html';
    ?>

    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<h2>Charts Of Star Wars</h2>

<div class='container-fluid padding-above container-color' style='padding-left: 30px; margin: 0;'>
    <div class='row py-2 align-items-center justify-content-center' style='width: 100%; height: 70vh;'>
        <!-- eye color graph -->
        <div class='col-md-6 px-4 border' style='height: 70vh;'>
            <h2>Eye Colors:</h2>
            <div style="width: 70%; margin: 0 auto; height: 60vh">
                <canvas id="eyeColorChart"></canvas>
            </div>

            <script>
                Chart.defaults.color = '#fff';
                // Chart data using PHP values
                var data = {
                    labels: <?php echo json_encode($eyeColorLabels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($eyeColorData); ?>,
                        backgroundColor: <?php echo json_encode($eyeColorColors); ?>,
                    }]
                };

                var ctx = document.getElementById('eyeColorChart').getContext('2d');
                var eyeColorChart = new Chart(ctx, {
                    type: 'pie',
                    data: data
                });
            </script>
        </div>
        <!-- population graph -->
        <div class='col-md-6 px-4 border' style='height: 70vh;'>
            <h2 >Top 10 Planet Populations:</h2>
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                <canvas id="populationChart"></canvas>
            </div>
            <script>
                // Chart data for population
                var populationData = {
                    labels: <?php echo json_encode($planetLabels); ?>,
                    datasets: [{
                        label: 'Population',
                        data: <?php echo json_encode($populationData); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                var populationCtx = document.getElementById('populationChart').getContext('2d');
                var populationChart = new Chart(populationCtx, {
                    type: 'bar',
                    data: populationData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- next row -->
    <div class='row py-2 align-items-center justify-content-center' style='width: 100%; height: 70vh;'>
        <!-- vehicle speed graph -->
        <div class='col-md-6 px-4 border' style='height: 70vh;'>
            <h2>Top 10 Vehicle Max Speeds:</h2>
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                <canvas id="vehicleSpeedChart"></canvas>
            </div>

            <script>
                // Chart data for vehicle speeds
                var populationData = {
                    labels: <?php echo json_encode($vehicleLabels); ?>,
                    datasets: [{
                        label: 'Max Atmosphering Speed (km/h)',
                        data: <?php echo json_encode($speedData); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                var populationCtx = document.getElementById('vehicleSpeedChart').getContext('2d');
                var populationChart = new Chart(populationCtx, {
                    type: 'bar',
                    data: populationData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
        <!-- Vehicle graph -->
        <div class='col-md-6 px-4 border' style='height: 70vh;'>
            <h2 >Top 10 Vehicle Costs:</h2>
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                <canvas id="vehicleCostChart"></canvas>
            </div>
            <script>
                // Chart data for vehicle speeds
                var populationData = {
                    labels: <?php echo json_encode($vehicleCostLabels); ?>,
                    datasets: [{
                        label: 'Cost (Credits)',
                        data: <?php echo json_encode($costData); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                var populationCtx = document.getElementById('vehicleCostChart').getContext('2d');
                var populationChart = new Chart(populationCtx, {
                    type: 'bar',
                    data: populationData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    <!-- next row -->
    <div class='row py-2 align-items-center justify-content-center' style='width: 100%; height: 70vh;'>
        <!-- gender graph -->
        <div class='col-md-6 px-4 border' style='height: 70vh;'>
            <h2>Gender Count:</h2>
            <div style="width: 70%; margin: 0 auto; height: 60vh">
                <canvas id="genderChart"></canvas>
            </div>

            <script>
                Chart.defaults.color = '#fff';
                // Chart data using PHP values
                var data = {
                    labels: <?php echo json_encode($genderLabels); ?>,
                    datasets: [{
                        data: <?php echo json_encode($genderData); ?>,
                        backgroundColor: <?php echo json_encode($genderColors); ?>,
                    }]
                };

                var ctx = document.getElementById('genderChart').getContext('2d');
                var eyeColorChart = new Chart(ctx, {
                    type: 'pie',
                    data: data
                });
            </script>
        </div>
        <!-- Starship Crew graph -->
        <div class='col-md-6 px-4 border' style='height: 70vh;'>
            <h2 >Top 5 Starship Crew Capacity:</h2>
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                <canvas id="starshipCrewChart"></canvas>
            </div>
            <script>
                // Chart data for Starship Crew
                var populationData = {
                    labels: <?php echo json_encode($starshipLabels); ?>,
                    datasets: [{
                        label: 'Capacity (people)',
                        data: <?php echo json_encode($starshipData); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                var populationCtx = document.getElementById('starshipCrewChart').getContext('2d');
                var populationChart = new Chart(populationCtx, {
                    type: 'bar',
                    data: populationData,
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true

                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</div>
</body>
</html>