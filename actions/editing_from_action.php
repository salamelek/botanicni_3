<?php
if (isset($_POST["imeLat"])) {
    $imeLat = mysqli_real_escape_string($conn, stripslashes($_POST["ime-lat"]));
    $imeSlo = mysqli_real_escape_string($conn, stripslashes($_POST["ime-slo"] ?? ""));
    $imeIta = mysqli_real_escape_string($conn, stripslashes($_POST["ime-ita"] ?? ""));
    $drugaImenaSlo = mysqli_real_escape_string($conn, stripslashes($_POST["druga-imena-slo"] ?? ""));
    $sorta = mysqli_real_escape_string($conn, stripslashes($_POST["sorta"]));
    $druzina = mysqli_real_escape_string($conn, stripslashes($_POST["druzina"]));
    $izvor = mysqli_real_escape_string($conn, stripslashes($_POST["izvor"] ?? ""));
    $habitat = mysqli_real_escape_string($conn, stripslashes($_POST["habitat"] ?? ""));
    $opis = mysqli_real_escape_string($conn, stripslashes($_POST["opis"] ?? ""));
    $zanimivosti = mysqli_real_escape_string($conn, stripslashes($_POST["zanimivosti"] ?? ""));
    $isAtSchool = isset($_POST["is-at-school"]);
}