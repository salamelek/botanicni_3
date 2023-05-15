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
        ?>

        <h1><i><?php echo $_GET["plant"] ?></i></h1>
<!--        TODO remove this on creating new plant-->
        <hr>

        <form action="./actions/editing_from_action.php" method="post" enctype="multipart/form-data">
            <div class="input-box">
                <label for="ime-lat">Latinsko ime: </label>
                <input type="text" id="ime-lat" name="ime-lat" value="<?php echo $plantDataAssoc["imeLat"] ?? ""?>" required>
            </div>
            <br>
            <div class="input-box">
                <label for="ime-slo">Slovensko ime: </label>
                <input type="text" id="ime-slo" name="ime-slo" value="<?php echo $plantDataAssoc["imeSlo"] ?? ""?>">
            </div>
            <br>
            <div class="input-box">
                <label for="ime-ita">Italijansko ime: </label>
                <input type="text" id="ime-ita" name="ime-ita" value="<?php echo $plantDataAssoc["imeIta"] ?? ""?>">
            </div>
            <br>
            <div class="input-box">
                <label for="druga-imena-slo">Druga slovenska imena: </label>
                <input type="text" id="druga-imena-slo" name="druga-imena-slo" value="<?php echo $plantDataAssoc["drugaImenaSlo"] ?? ""?>">
            </div>
            <br>
            <div class="input-box">
                <label for="sorta">Sorta: </label>
                <input type="text" id="sorta" name="sorta" value="<?php echo $plantDataAssoc["sorta"] ?? ""?>">
            </div>
            <br>
            <div class="input-box">
                <label for="druzina">Družina: </label>
                <input type="text" id="druzina" name="druzina" value="<?php echo $plantDataAssoc["druzina"] ?? ""?>" required>
            </div>
            <br>
            <div class="input-box">
                <label for="izvor">Izvor: </label>
                <textarea name="izvor" id="izvor" cols="30" rows="5"><?php echo $plantDataAssoc["izvor"] ?? ""?></textarea>
            </div>
            <br>
            <div class="input-box">
                <label for="habitat">Habitat: </label>
                <textarea name="habitat" id="habitat" cols="30" rows="5"><?php echo $plantDataAssoc["habitat"] ?? ""?></textarea>
            </div>
            <br>
            <div class="input-box">
                <label for="opis">Opis: </label>
                <textarea name="opis" id="opis" cols="30" rows="5"><?php echo $plantDataAssoc["opis"] ?? ""?></textarea>
            </div>
            <br>
            <div class="input-box">
                <label for="zanimivosti">Zanimivosti: </label>
                <textarea name="zanimivosti" id="zanimivosti" cols="30" rows="5"><?php echo $plantDataAssoc["zanimivosti"] ?? ""?></textarea>
            </div>
            <br>
            <div class="input-box">
                <label for="source">Viri: </label>
                <textarea name="viri" id="source" cols="30" rows="5"><?php echo $plantDataAssoc["viri"] ?? ""?></textarea>
            </div>
            <br>
            <div class="input-box">
                <label for="is-at-school">Se nahaja na šoli: </label>
                <input type="checkbox" id="is-at-school" name="is-at-school" <?php if (isset($plantDataAssoc) && $plantDataAssoc["isAtSchool"] == 1) {echo "checked";} ?>>
            </div>
            <br>
            <hr>
            <label for="upload-images">Dodaj slike:</label>
            <input type="file" multiple="multiple" id="upload-images" name="imagesUpload[]">
            <hr>

            <?php
            if ($_GET["plant"] != "new") {
                $dirName = "./images/plants/" . $plantDataAssoc["imeLat"] . "/";
                $fileCount = count(glob($dirName . "*"));

                if (isset($plantDataAssoc) && $fileCount > 0) {
                    include "./modules/delete_images.php";
                }
            }
            ?>
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
<!--            TODO delete all images and dir upon deleting plant-->
        </form>
    </div>
</main>
<?php
include "./modules/footer.php";
include "./modules/js_script.php";
?>