<?php
require "database.php";

if (isset($_POST["login-password"]) and isset($_POST["login-username"])) {
    $usr = $_POST["login-username"];
    $psw = $_POST["login-password"];

    if (!check_credentials($usr, $psw)) {
        echo "wrong credentials!";
        return;
    }

    $_SESSION["username"] = $usr;
}
?>

<main>
    <form action="" method="post">
        <label for="login-usr">uporabniško ime: </label>
        <input id="login-usr" name="login-username" type="text" required>
        <br>
        <label for="login-psw">Geslo:</label>
        <input id="login-psw" name="login-password" type="password" required>
        <br>
        <input type="submit" value="Log in">
    </form>
</main>