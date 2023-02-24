<?php
require "../database.php";


$adminPsw = "testpsw";


if (isset($_REQUEST["username"])) {
    $username = mysqli_real_escape_string($conn, stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, stripslashes($_POST["password"]));
    $adminPswInput = mysqli_real_escape_string($conn, stripslashes($_POST["admin-password"]));

    $isAdmin = 0;
    if (isset($_POST["is-admin"])) {
        if ($adminPswInput == $adminPsw) {
            $isAdmin = 1;
        } else {
            $_SESSION["result-msg"] = "Zgrešeno geslo urejevalca!";
            header("Location: ../register.php");
            return;
        }
    }

    $sql = "INSERT into Users (username, pswHash, isAdmin)
        VALUES ('$username', '" . md5($password) . "', '$isAdmin');
    ";

    try {
        mysqli_query($conn, $sql);
        header("Location: ../login.php");
    } catch (Exception $e) {
        // error code 1049 stands for "duplicate entry"
        if ($e->getCode() == 1062) {
            echo "<script type='text/javascript'>alert('Uporabniško ime " . $username . " je že uporabljeno!');</script>";
        } else {
            echo "Napaka! In sicer sledeča:<br>" . $e;
        }
    }
}