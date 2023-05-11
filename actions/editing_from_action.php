<?php
require "../database.php";


$images_path = "../images/plants/";

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
            "viri"          => mysqli_real_escape_string($conn, stripslashes($_POST["viri"])),
            "isAtSchool"    => isset($_POST["is-at-school"]) ? 1 : 0,
            "oldId"         => mysqli_real_escape_string($conn, stripslashes($_POST["oldId"]))
        ]
    );

    // save images
    print_r($_FILES["imagesUpload"]);

    for($i=0; $i < count($_FILES['imagesUpload']['name']); $i++) {
        $target_dir = $images_path . $_POST["ime-lat"];
        $target_file = $target_dir . "/" . $_FILES['imagesUpload']['name'][$i];

        // create directory
        if (!file_exists($target_dir)) {
            mkdir($images_path . $_POST["ime-lat"]);
        }

        // check if file already exists

        // limit file size

        // limit file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // move file from temp to directory
        $tmp_files = $_FILES["imagesUpload"]["tmp_name"];
        move_uploaded_file($tmp_files[$i], $target_file);
    }
}

header("Location: ../admins_only.php");