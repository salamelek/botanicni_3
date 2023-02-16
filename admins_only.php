<?php
require "database.php";
require "auth_session.php";

if (!is_admin($_SESSION["username"])) {
    header("Location: missing_admin_perms");
    exit;
}