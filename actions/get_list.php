<?php
require "../database.php";

$numToLoad = $_GET["num"];
$offset = $_GET["offs"];
$order = $_GET["order"];
$place = $_GET["place"];
$lang = $_GET["lang"];








// select num of plants with correct offset
$plantList = get_n_plants($numToLoad, $offset);

foreach ($plantList as $plant) {
    $plantAssoc = get_plant_assoc($plant);

}