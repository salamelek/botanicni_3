<?php
include "./modules/head.php";
include "./modules/nav.php";

session_start();
?>

<main>
    <div class="main-wrapper">
        <form action="./actions/login_action.php" method="post">
            <div class="login-form-input">
                <label for="login-usr">Uporabniško ime: </label>
                <input id="login-usr" name="login-username" type="text" required autofocus>
            </div>
            <hr>
            <div class="login-form-input">
                <label for="login-psw">Geslo:</label>
                <input id="login-psw" name="login-password" type="password" required>
            </div>
            <br>
            <input type="submit" value="Log in">
        </form>
        <?php
        if (isset($_SESSION["action-result-msg"])) {
            echo "<div><p>" . $_SESSION["action-result-msg"] . "</p></div>";
            unset($_SESSION["action-result-msg"]);
        }
        ?>
    </div>
</main>