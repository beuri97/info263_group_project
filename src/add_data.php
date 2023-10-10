<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>

    <?php

    include 'headerPage.html';

    ?>
    <!-- Page Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'/>
    <link href="https://fonts.cdnfonts.com/css/sf-distant-galaxy" rel="stylesheet">
    <link rel="stylesheet" href="css/filmsStyle.css">
</head>

<style>
    td {
        text-align: center;
        font-family: Arial;
        font-weight: bold;
        border: 1px white solid;
    }
    input[type="text"] {
        width: 100%;
        box-sizing: border-box;
    }
    textarea {
        width: 100%;
        box-sizing: border-box;
    }
    input[type="date"] {
        width: 100%;
        box-sizing: border-box;
        text-align: center;
    }
    table{
        width: 50%;
        border: 3px white solid;

    }
    th {
        border: 1px white solid;
    }
    div[id="Add_data_film"] {
        margin-left: 3%;
    }
</style>

<body>
<br>
<br>
<h2>Add Film</h2>
<div id = "Add_data_film">
    <form action="add_data.php" method="post">
        <table style="text-align: center">
            <tr>
                <td><label for="input-title">Title</label></td>
                <td id="td-title"><input id = "input-title" type="text" name = "title" ></td>
                <td><label for="input-episode">Episode</label></td>
                <td colspan="3" id="td-episode"><input type="text" id="input-episode" name="episode" ></td>
                <td><label for="input-director">Director</label></td>
                <td id="td-director"><input type="text" id="input-director" name="director" ></td>
                <td><label for="input-date">Date</label></td>
                <td id="td-date"><input type="date" id="input-date" name="release_date" ></td>
            </tr>
            <tr>
                <td><label for="input-crawl">Opening Crawl</label></td>
                <td colspan="9" id="td-crawl"><textarea id="input-crawl" style="resize: none" rows="10" name="crawl">Enter text here.</textarea> </td>
            </tr>
            <tr>
                <td><label for="input-url">image URL</label></td>
                <td colspan="9"><input type="text" id="input-url" name="url"></td>
            </tr>
        </table>
        <br>
        <input type="submit" id="submit" name="add" value="Add" style="margin-left: 1%" onclick="change_border_box()">
    </form>
</div>

<script>
    function show_required (name) {
        let INPUT_PREFIX = "input";
        var field = document.getElementById(INPUT_PREFIX.concat("-", name)).value;
        let TD_PREFIX = "td"
        document.getElementById(TD_PREFIX.concat("-", name)).style.borderColor = (field.value == "" || field.value == null) ? "red" : "black";
    }

    function change_border_box() {
        let names = ["title", "episode", "director", "date", "crawl"];
        for(let i=0; i<names.length; i++) {
            show_required(names[i]);
        }
    }
</script>
<?php

try {
    $db = new PDO("sqlite:resources/star_wars.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}
// important
if (isset($_POST['title']))
{
    $title = $_POST['title'];
} else {
    $title = NULL;
}

$episode = $_POST['episode'];
$director = $_POST['director'];
$release = $_POST['release_date'];
$crawl = $_POST['crawl'];

echo $release;

if(isset($_POST['add']) and $title != '' and $episode != '' and $director != ''
    and $release != '' and $crawl != '') {
    echo "HELLO IT starts here";
    $result = $db->query("SELECT max(filmID) as num from film");
    $resultNum = $result->fetch(PDO::FETCH_ASSOC);
    $number = $resultNum['num'] + 1;
    $url = ($_POST['url'] == '') ? NULL : $_POST['url'];
    echo "test1";
    $query = "INSERT INTO film(filmID, film_title, film_episode_id, film_opening_crawl, film_director, film_release_date, image_url)
                values($number, $title, $episode, $crawl, $director, $release, $url)";
    echo "test2";
    $stmt = $db->prepare($query);
    echo "test3";
    $stmt->execute();
    $db = null;
    echo "SUCCESS";

} else if(isset($_POST['add']) and ($title == '' or $episode == '' or $director == ''
        or $release == '' or $crawl == '')) {
    echo "Need to type required text!!";
}
?>
</body>
</html>


