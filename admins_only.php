<?php

if (!is_admin($_SESSION["username"])) {
    header("Location: missing_admin_perms");
    exit;
}