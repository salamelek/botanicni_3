<?php
require "./database.php";

include "./modules/head.php";
include "./modules/nav.php";

$plantList = get_n_plants(100, 0);
?>

<main>
    <div class="main-wrapper">
        <h1>Seznam rastlin</h1>
        <hr>
        <div>
            filters here? idk
        </div>
        <hr>
        <div>
            <?php
            foreach ($plantList as $plant) {
                echo '
                    <a href="./plant.php?plant=' . $plant . '">' . $plant . '</a>
                    <br>
                ';
            }
            ?>
        </div>
    </div>
</main>