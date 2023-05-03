<?php
require "./database.php";

include "./modules/head.php";
include "./modules/nav.php";

session_start();

$plantList = get_n_plants(100, 0);

/* HOW TO LOAD LIST
 *
 * 1) Get the language to filter by
 * 2) Get if the user wants only plants in school
 * 3) Get the sort order (A-Z | Z-A |)
 * 4) Make the query
 * */
?>

<main>
    <div class="main-wrapper">
        <h1>Seznam rastlin</h1>
        <hr>
        <div class="sort-by-filters-div">
            <div class="filters-container">
                <button onclick="changeOrder(this)">A-Z</button>
                <button onclick="changePosition(this)">Samo v šoli</button>
                <button onclick="changeLanguage(this)">Latinščina</button>
                <button onclick="updateList()">Osveži</button>
            </div>
        </div>
        <hr>
        <div class="link-holder" id="link-holder">
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
        <hr>
        <div>
            <h3>[Load more]</h3>
        </div>
    </div>
</main>

<?php include "./modules/js_script.php";?>