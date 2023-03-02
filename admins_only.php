<?php
require "database.php";
require "auth_session.php";

include "./modules/head.php";
include "./modules/nav.php";

// ?editing=new
// ?editing=Testus%20plantis
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
        if (!isset($_GET["editing"])) {
            include "./modules/editing_options.php";
            return;
        }
        ?>

        <form action="./actions/editing_from_action.php" method="post">
            <label for="ime-lat">Latinsko ime: </label>
            <input type="text" id="ime-lat" name="ime-lat">
            <br>
            <label for="ime-slo">Slovensko ime: </label>
            <input type="text" id="ime-slo" name="ime-slo">
            <br>
            <label for="ime-ita">Italijansko ime: </label>
            <input type="text" id="ime-ita" name="ime-ita">
            <br>
            <label for="druga-imena-slo">Druga slovenska imena: </label>
            <input type="text" id="druga-imena-slo" name="druga-imena-slo">
            <br>
            <label for="sorta">Sorta: </label>
            <input type="text" id="sorta" name="sorta">
            <br>
            <label for="druzina">Družina: </label>
            <input type="text" id="druzina" name="druzina">
            <br>
            <label for="izvor">Izvor: </label>
            <input type="text" id="izvor" name="izvor">
            <br>
            <label for="habitat">Habitat: </label>
            <input type="text" id="habitat" name="habitat">
            <br>
            <label for="opis">Opis: </label>
            <input type="text" id="opis" name="opis">
            <br>
            <label for="zanimivosti">Zanimivosti: </label>
            <input type="text" id="zanimivosti" name="zanimivosti">
            <br>
            <label for="is-at-school">Se nahaja na šoli: </label>
            <input type="checkbox" id="is-at-school" name="is-at-school">
        </form>
    </div>
</main>
