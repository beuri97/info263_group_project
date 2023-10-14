<?php
require 'classes/Person.php'; // Include the Person class

// Fetch height data for people with IDs up to 30
$heightData = [];
for ($i = 1; $i <= 30; $i++) {
    $person = Person::findById($i);
    if ($person) {
        $heightData[] = [
            'name' => $person->getName(),
            'height' => $person->getHeight()
        ];
    }
}

// Prepare data for the chart
$labels = [];
$heights = [];
foreach ($heightData as $data) {
    $labels[] = $data['name'];
    $heights[] = $data['height'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Height Comparison Chart</title>

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
<div class='container-fluid padding-above container-color' style='width: 100% height: 100vh' >
    <div class='row py-2 justify-content-center' style='width: 100% height: 100vh'>
        <div class='col-md-6 px-4' style='width: 100% height: 100vh'>
            <div style="width: 80%; margin: 0 auto;">
                <canvas id="myChart"></canvas>
            </div>

            <script>
                // Chart data using PHP values
                var data = {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                        label: 'Height Comparison',
                        data: <?php echo json_encode($heights); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
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
        <div class='col-md-6 px-4' style='width: 100% height: 100vh'>
        </div>
    </div>
</div>
</body>
</html>