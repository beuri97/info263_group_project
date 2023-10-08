<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>
</head>

<?php

include 'headerPage.html';

?>

<style>
    td {
        text-align: center;
        font-family: Arial;
        font-weight: bold;
        border: 1px black solid;
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
        border: 1px black solid;

    }
    th {
        border: 1px black solid;
    }
    div[id="Add_data_film"] {
        margin-left: 3%;
    }
</style>

<body>
<h1>Star Wars</h1>
<br>
<br>
<h2>Add Film</h2>
<p>Add additional data to provide accurate information!!</p>
<div id = "Add_data_film">
    <form action="add_data.php" method="post">
        <table>
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
                <td colspan="9" id="td-crawl"><textarea id="input-crawl" style="resize: none" rows="10" >Enter text here.</textarea> </td>
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

$title = $_POST['title'];
$episode = $_POST['episode'];
$director = $_POST['director'];
$release = $_POST['release_date'];
$crawl = $_POST['input-crawl'];

if(isset($_POST['add']) and $title != '' and $episode != '' and $director != ''
    and $release != '' and $crawl != '') {
    $db = openConnection();
    $number = $db->query("SELECT max(filmID) from film")->fetch() + 1;
    $url = ($_POST['url'] == '') ? NULL : $_POST['url'];
    $query = "INSERT INTO film values($number, $title, $episode, $crawl, $director, $release, $url )";
    $db->query($query);
    $db = null;

} else if(isset($_POST['add']) and ($title == '' or $episode == '' or $director == ''
        or $release == '' or $crawl == '')) {
    echo "Need to type required text!!";
}
?>
</body>
</html>


