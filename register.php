<?php
include "./modules/head.php";
include "./modules/nav.php";

session_start();
?>

<main>
    <div class="main-wrapper">
        <form action="actions/register_action.php" method="post">
            <div class="login-form-input">
                <label for="username">Uporabniško ime: </label>
                <input type="text" id="username" name="username" maxlength="255" required autofocus>
            </div>
            <hr>
            <div class="login-form-input">
                <label for="password">Geslo: </label>
                <input id="password" name="password" type="password" maxlength="255" required>
            </div>
            <hr>
            <label for="is-admin">Hočem biti urejevalec: </label>
            <input type="checkbox" id="is-admin" name="is-admin" value="0">
            <br>
            <div id="admin-password-id" hidden>
                <div class="login-form-input">
                    <label for="admin-password">Geslo za urejevalca: </label>
                    <input type="password" id="admin-password" name="admin-password">
                </div>
            </div>
            <br>
            <input type="submit" value="Oddaj">
        </form>
        <div class="action-result-msg">
            <p>
                <?php
                if (isset($_SESSION["action-result-msg"])) {
                    echo $_SESSION["action-result-msg"];
                    unset($_SESSION["action-result-msg"]);
                }
                ?>
            </p>
        </div>
    </div>
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