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
$dirName = "./images/plants/" . $plantInfo["imeLat"] . "/";
$fileCount = count(glob($dirName . "*"));

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
        <hr <?php if ($fileCount == 0) {echo "hidden";} ?>>

        <div class="img-gallery" id="img-gallery" <?php if ($fileCount == 0) {echo "hidden";} ?>>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php
                    if ($fileCount != 0) {
                        $dir = new DirectoryIterator($dirName);
                        foreach ($dir as $fileInfo) {
                            if (!$fileInfo->isDot() && !$fileInfo->isDir()) {
                                $fileName = $fileInfo->getFilename();

                                echo ' 
                                <div class="swiper-slide">
                                    <div class="swiper-zoom-container">
                                        <div class="my-inner-slide">
                                            <img src="' . $dirName . $fileName . '" alt="lepa slikca">
                                        </div>
                                    </div>
                                </div>
                            ';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <div class="swiper-pagination"></div>
            </div>
            <script>
                let swiper = new Swiper(".mySwiper", {
                    loop: true,
                    zoom: {
                        maxRatio: 5,
                    },
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    }
                });
            </script>
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