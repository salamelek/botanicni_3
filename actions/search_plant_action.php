<?php
if (isset($_POST["search-plant-input"])) {
    header("Location: ../plant.php?plant=" . $_POST["search-plant-input"]);
}