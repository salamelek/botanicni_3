<?php
require "../database.php";

session_start();


if (isset($_POST["ime-lat"])) {
    add_or_edit_plant(
        [
            "imeLat"        => mysqli_real_escape_string($conn, stripslashes($_POST["ime-lat"])),
            "imeSlo"        => mysqli_real_escape_string($conn, stripslashes($_POST["ime-slo"] ?? "")),
            "imeIta"        => mysqli_real_escape_string($conn, stripslashes($_POST["ime-ita"] ?? "")),
            "drugaImenaSlo" => mysqli_real_escape_string($conn, stripslashes($_POST["druga-imena-slo"] ?? "")),
            "sorta"         => mysqli_real_escape_string($conn, stripslashes($_POST["sorta"])),
            "druzina"       => mysqli_real_escape_string($conn, stripslashes($_POST["druzina"])),
            "izvor"         => mysqli_real_escape_string($conn, stripslashes($_POST["izvor"] ?? "")),
            "habitat"       => mysqli_real_escape_string($conn, stripslashes($_POST["habitat"] ?? "")),
            "opis"          => mysqli_real_escape_string($conn, stripslashes($_POST["opis"] ?? "")),
            "zanimivosti"   => mysqli_real_escape_string($conn, stripslashes($_POST["zanimivosti"] ?? "")),
            "isAtSchool"    => isset($_POST["is-at-school"]) ? 1 : 0,
            "oldId"         => mysqli_real_escape_string($conn, stripslashes($_POST["oldId"]))
        ]
    );
}

header("Location: ../admins_only.php");