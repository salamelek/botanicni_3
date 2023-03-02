<?php
include "./modules/head.php";
include "./modules/nav.php";

require "./database.php";
// https://botanicni3/plant.php?plant=plantus%20comunis

if (!isset($_GET["plant"])) {
    include "./modules/search_plant.php";
    return;
}


$plantInfo = get_plant_assoc(plantLatName: $_GET["plant"]);
?>

<main>
    <div class="main-wrapper">
        <?php
        if (!$plantInfo) {
            echo "Te rastline ni v podatkovni bazi.";
            return;
        }
        print_r($plantInfo);
        ?>
    </div>
</main>

