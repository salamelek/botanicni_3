<?php
require "./database.php";
// https://botanicni3/plant.php?plant=plantus%20comunis

if (!isset($_GET["plant"])) {
    include "./modules/search_plant.php";
    return;
}


$plantInfo = get_plant_assoc(plantLatName: $_GET["plant"]);
if (!$plantInfo) {
    echo "no such plant found";
    return;
}

print_r($plantInfo);
?>

hello from plant

