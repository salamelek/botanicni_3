<?php
if (isset($_POST["search-plant-input"])) {
    header("Location: ../" . $_POST["prevFileName"] . "?plant=" . $_POST["search-plant-input"]);
}