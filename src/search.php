<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - Search</title>

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
<body>

<?php
if (isset($_POST['query'])) {
    echo "<h3 style='text-align: center; padding-top: 40px' > SEARCH FOR: " . $_POST['query'] . "</h3>";
}
    ?>

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
<?php
// Require classes
require 'classes/Person.php';

if (isset($_POST['query'])) {
    $search_query = $_POST['query'];

    // Call a method in your PHP class to search for results
    $personResults = Person::searchPeople($search_query);
    // Display the person results
    if (empty($personResults)) {
        echo "No results found.";
    } else {
        echo '<h2>People:</h2>';
        echo '<div class="cast-container" style="justify-content: center;">';
        foreach ($personResults as $result) { ?>
            <a href='peopleInfo.php?id=<?php echo $result->getId(); ?>' class="cast-item">
                <img class='cast-image' height='150' src='<?php echo $result->getImage(); ?>' alt='(Missing) Image Of:' /><br />
                <p> <?php echo $result->getName() ?> </p>
            </a>
            <?php
        }
        echo '</div>'; // Close the cast-container div
    }
}
?>


</body>
</html>