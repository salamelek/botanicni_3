<?php
require "../database.php";

if (isset($_POST["delete-plant"])) {
    delete_plant(null, $_POST["oldId"]);
//    header("Location: ../admins_only.php");
}