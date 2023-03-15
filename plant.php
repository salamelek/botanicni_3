<?php
require "./database.php";

include "./modules/head.php";
include "./modules/nav.php";

session_start();


if (!isset($_GET["plant"])) {
    include "./modules/search_plant.php";
    return;
}

$plantInfo = get_plant_assoc($_GET["plant"]);
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
            <h1><i><?php echo $plantInfo["imeLat"]; ?></i></h1>
            <?php
            if (isset($_SESSION["username"]) && is_admin($_SESSION["username"])) {
                echo '<a href="./admins_only.php?plant=' . $plantInfo["imeLat"] . '" class="nice-link">Uredi <img class="icon" src="images/pencil_icon.png" alt="icon"></a>';
            }
            ?>
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

