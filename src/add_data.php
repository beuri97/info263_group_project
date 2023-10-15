<?php

include_once "resources/database.php";

$people = null;
$vehicle = null;
$planet = null;
$starShip = null;

$data = file_get_contents("php://input");
$dataArray = json_decode($data);
$people = $dataArray[0];
$planet = $dataArray[1];
$vehicle = $dataArray[2];
$starShip = $dataArray[3];


echo count($people);
echo count($planet);
echo count($vehicle);
echo count($starShip);
