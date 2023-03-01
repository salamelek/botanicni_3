<?php
session_start();
// if the session username is not set, it redirects the user to the login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}