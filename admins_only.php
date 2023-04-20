<?php
require "auth_session.php";
require "database.php";

include "./modules/head.php";
include "./modules/nav.php";
?>

<main>
    <div class="main-wrapper">
        <?php
        // check if user doesn't have the necessary permissions
        if (!is_admin($_SESSION["username"])) {
            echo "<p>Nimaš dostopa do te strani!</p>";
            return;
        }

        // check if link doesn't have the option already selected
        if (!isset($_GET["plant"])) {
            include "./modules/editing_options.php";
            return;
        }


        if ($_GET["plant"] == "search") {
            include "./modules/search_plant.php";
            return;
        }

        $plantDataAssoc = get_plant_assoc($_GET["plant"]);

        if (!isset($plantDataAssoc)) {
            if ($_GET["plant"] != "new") {
                echo '
                    <h3>Ustvari novo rastlino ' . $_GET["plant"] . '</h3>
                ';
            } else {
                echo '
                    <h3>Nova rastlina</h3>
                ';
            }

        }

        $plantInfo = get_plant_assoc($_GET["plant"]);
        $dirName = "./images/plants/" . $plantInfo["imeLat"] . "/";
        $fileCount = count(glob($dirName . "*"));
        ?>

        <form action="./actions/editing_from_action.php" method="post" enctype="multipart/form-data">
            <label for="ime-lat">Latinsko ime: </label>
            <input type="text" id="ime-lat" name="ime-lat" value="<?php echo $plantDataAssoc["imeLat"] ?? ""?>" required>
            <br>
            <label for="ime-slo">Slovensko ime: </label>
            <input type="text" id="ime-slo" name="ime-slo" value="<?php echo $plantDataAssoc["imeSlo"] ?? ""?>">
            <br>
            <label for="ime-ita">Italijansko ime: </label>
            <input type="text" id="ime-ita" name="ime-ita" value="<?php echo $plantDataAssoc["imeIta"] ?? ""?>">
            <br>
            <label for="druga-imena-slo">Druga slovenska imena: </label>
            <input type="text" id="druga-imena-slo" name="druga-imena-slo" value="<?php echo $plantDataAssoc["drugaImenaSlo"] ?? ""?>">
            <br>
            <label for="sorta">Sorta: </label>
            <input type="text" id="sorta" name="sorta" value="<?php echo $plantDataAssoc["sorta"] ?? ""?>">
            <br>
            <label for="druzina">Družina: </label>
            <input type="text" id="druzina" name="druzina" value="<?php echo $plantDataAssoc["druzina"] ?? ""?>" required>
            <br>
            <label for="izvor">Izvor: </label>
            <input type="text" id="izvor" name="izvor" value="<?php echo $plantDataAssoc["izvor"] ?? ""?>">
            <br>
            <label for="habitat">Habitat: </label>
            <input type="text" id="habitat" name="habitat" value="<?php echo $plantDataAssoc["habitat"] ?? ""?>">
            <br>
            <label for="opis">Opis: </label>
            <input type="text" id="opis" name="opis" value="<?php echo $plantDataAssoc["opis"] ?? ""?>">
            <br>
            <label for="zanimivosti">Zanimivosti: </label>
            <input type="text" id="zanimivosti" name="zanimivosti" value="<?php echo $plantDataAssoc["zanimivosti"] ?? ""?>">
            <br>
            <label for="is-at-school">Se nahaja na šoli: </label>
            <input type="checkbox" id="is-at-school" name="is-at-school" <?php if (isset($plantDataAssoc) && $plantDataAssoc["isAtSchool"] == 1) {echo "checked";} ?>>
            <br>
            <hr>
            <label for="upload-images">Dodaj slike:</label>
            <input type="file" multiple="multiple" id="upload-images" name="imagesUpload[]">
            <hr>

            <p>Izbriši slike:</p>
            <div class="delete-images-gallery">
                <div class="delete-images-inner">
                    <?php
                    if ($fileCount != 0) {
                        $dir = new DirectoryIterator($dirName);
                        foreach ($dir as $fileInfo) {
                            if (!$fileInfo->isDot() && !$fileInfo->isDir()) {
                                $fileName = $fileInfo->getFilename();

                                echo ' 
                                <div class="delete-img-frame">
                                    <img src="' . $dirName . $fileName . '" alt="lepa slikca" onclick="deleteImage(this) ">
                                </div>
                            ';
                            }
                        }
                    }
                    ?>
                </div>
                <div class="confirm-delete-prompt" id="confirm-delete-popup">
                    <p>Ali želiš izbrisati izbrano sliko?</p>
                    <div class="options-container">
                        <button type="button" onclick="closePopup()" id="delete-image-confirmed">DA</button>
                        <button type="button" onclick="closePopup()">NE</button>
                    </div>
                </div>
            </div>

            <br>
            <hr>
            <label>
                <input type="number" name="oldId" value="<?php echo $plantDataAssoc["id"] ?>" hidden>
            </label>
            <input type="submit" value="Oddaj">
        </form>
        <form action="./actions/delete_plant_action.php" method="post">
            <label>
                <input type="number" name="oldId" value="<?php echo $plantDataAssoc["id"] ?>" hidden>
            </label>
            <input type="submit" name="delete-plant" value="Izbriši">
        </form>
    </div>
</main>
<?php
include "./modules/js_script.php"
?>