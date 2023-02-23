<?php
require "./database.php";

include "./modules/head.php";
include "./modules/nav.php";


if (isset($_REQUEST["username"])) {
    echo "ok...";

    $username = mysqli_real_escape_string($conn, stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST["password"]));
    $isAdmin = isset($_POST["is-admin"]) ? 1 : 0;

    $sql = "
    INSERT into Users (username, pswHash, isAdmin)
    VALUES ('$username', '" . md5($password) . "', '$isAdmin');
    ";

    try {
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: login.php");
        } else {
            echo "prišlo je do napakeeeeee";
        }
    } catch (Exception $e) {
        // error code 1049 stands for "duplicate entry"
        if ($e->getCode() == 1062) {
            echo "<script type='text/javascript'>alert('Uporabniško ime " . $username . " je že uporabljeno!');</script>";
        } else {
            echo "Napaka! in sicer sledeča: " . $e;
        }
    }

}
?>

<main>
    <form action="" method="post">
        <label for="username">Uporabniško ime: </label>
        <input type="text" id="username" name="username" maxlength="255" required>
        <br>
        <label for="password">Geslo: </label>
        <input id="password" name="password" type="text" maxlength="255" required>
        <br>
        <label for="is-admin">Admin: </label>
        <input type="checkbox" id="is-admin" name="is-admin">
        <br>
        <input type="submit" value="Oddaj">
    </form>
</main>