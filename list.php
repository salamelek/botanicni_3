<?php
require "./database.php";

include "./modules/head.php";
include "./modules/nav.php";

session_start();

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
        <div class="link-holder">
            <?php
            $i = 0;
            foreach ($plantList as $plant) {
                echo '
                    <div class="plant-link ' . ($i % 2 == 0 ? 'link-light' : 'link-dark') . '">
                        <a href="./plant.php?plant=' . $plant . '" class="nice-link"><p>' . $plant . '</p></a>
                ';

                if (isset($_SESSION["username"]) && is_admin($_SESSION["username"])) {
                    echo '
                        <div class="plant-link-editing">
                            <a href="./admins_only.php?plant=' . $plant . '"><p><img class="icon" src="images/pencil_icon.png" alt="icon"></p></a>
                        </div>
                    ';
                }

                echo '</div>';
                $i++;
            }
            ?>
        </div>
    </div>
</main>