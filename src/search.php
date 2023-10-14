<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Filter And Search</title>
    <!-- Google Font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
            rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/stylesearch.css" />

</head>
<body>
<section class="container">
    <form>
        <img src="img/magnifyingblack.png" style="width:15px; height:15px;">
        <input type="text" name="" id="search-item" placeholder="Search the force...">
    </form>

    <div id="buttons">
        <button class="button-value" onclick="filterResults('all')">All</button>
        <button class="button-value" onclick="filterResults('Films')">
            Films
        </button>
        <button class="button-value" onclick="filterProduct('Planets')">
            Planets
        </button>
        <button class="button-value" onclick="filterProduct('People')">
            People
        </button>
        <button class="button-value" onclick="filterProduct('Starships')">
            Starships
        </button>
        <button class="button-value" onclick="filterProduct('Vehicles')">
            Vehicles
        </button>

    </div>

</section>
    <!-- Script -->
<script src="js/app.js"></script>

</body>
</html>