<?php
require "../database.php";

session_start();

if (isset($_POST["login-password"]) and isset($_POST["login-username"])) {
    $usr = mysqli_real_escape_string($conn, stripslashes($_POST["login-username"]));
    $psw = mysqli_real_escape_string($conn, stripslashes($_POST["login-password"]));

    if (!check_credentials($usr, $psw)) {
        echo "Napačni par uporabniškega imena in gesla!";
        return;
    }

    $_SESSION["username"] = $usr;
    header("Location: ../admins_only.php");
}