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
        ?>
        <div class="plant-title">
            <h1><?php echo $plantInfo["imeLat"]; ?></h1>
            <a href="./admins_only.php?plant=<?php echo $plantInfo["imeLat"]; ?>" class="nice-link">Uredi</a>
        </div>
        <hr>
        <h4>Slovensko ime: </h4>
        <?php echo $plantInfo["imeSlo"]; ?>
        <h4>Italijansko ime: </h4>
        <?php echo $plantInfo["imeIta"]; ?>
        <h4>Druga slovenska imena: </h4>
        <?php echo $plantInfo["drugaImenaSlo"]; ?>
        <h4>Sorta: </h4>
        <?php echo $plantInfo["sorta"]; ?>
        <h4>Družina: </h4>
        <?php echo $plantInfo["druzina"]; ?>
        <h4>Izvor: </h4>
        <?php echo $plantInfo["izvor"]; ?>
        <h4>Habitat: </h4>
        <?php echo $plantInfo["habitat"]; ?>
        <h4>Opis: </h4>
        <?php echo $plantInfo["opis"]; ?>
        <h4>Zanimivosti: </h4>
        <?php echo $plantInfo["zanimivosti"]; ?>
        <h4>Ali jo imamo na šoli: </h4>
        <?php echo $plantInfo["isAtSchool"] ? "Da" : "Ne"; ?>
    </div>
</main>

