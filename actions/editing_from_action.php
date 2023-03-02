<?php
if (isset($_POST["imeLat"])) {
    $imeLat = $_POST["ime-lat"] ?? "";
    $imeSlo = $_POST["ime-slo"] ?? "";
    $imeIta = $_POST["ime-ita"] ?? "";
    $drugaImenaSlo = $_POST["druga-imena-slo"] ?? "";
    $sorta = $_POST["sorta"] ?? "";
    $druzina = $_POST["druzina"] ?? "";
    $izvor = $_POST["izvor"] ?? "";
    $habitat = $_POST["habitat"] ?? "";
    $opis = $_POST["opis"] ?? "";
    $zanimivosti = $_POST["zanimivosti"] ?? "";
    $isAtSchool = isset($_POST["is-at-school"]);


}