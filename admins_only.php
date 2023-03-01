<?php
require "database.php";
require "auth_session.php";

include "./modules/head.php";
include "./modules/nav.php";

if (!is_admin($_SESSION["username"])) {
    echo "Nimaš dostopa do te strani!";
    return;
}
?>

<main>
    <div>
        <p>Uredi obstoječo rastlino</p>
        <p>Dodaj novo rastlino</p>
    </div>
</main>
