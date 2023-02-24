<?php
include "./modules/head.php";
include "./modules/nav.php";
?>

<main>
    <form action="./modules/register_action.php" method="post">
        <label for="username">Uporabniško ime: </label>
        <input type="text" id="username" name="username" maxlength="255" required>
        <br>
        <label for="password">Geslo: </label>
        <input id="password" name="password" type="password" maxlength="255" required>
        <br>
        <label for="is-admin">Hočem biti urejevalec: </label>
        <input type="checkbox" id="is-admin" name="is-admin" value="0">
        <br>
        <div id="admin-password-id" hidden>
            <label for="admin-password">Geslo za urejevalca: </label>
            <input type="password" id="admin-password" name="admin-password">
        </div>
        <br>
        <input type="submit" value="Oddaj">
    </form>
</main>
<script>
    let adminCheckbox = document.getElementById("is-admin");
    let adminPassword = document.getElementById("admin-password-id");

    adminCheckbox.addEventListener("click", function() {
        if (adminCheckbox.checked) {
            adminPassword.removeAttribute("hidden");
        } else {
            adminPassword.setAttribute("hidden", "true");
        }
    })
</script>