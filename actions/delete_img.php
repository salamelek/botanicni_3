<?php
// FIXME on server gets wrong file (eg.: Could not delete /home/riki/SALAM/internet/public in /images/plants/Acer campestre/IMG-20230402-WA0011.jpeg, file does not exist)

if (array_key_exists('file', $_REQUEST)) {
    $imgPath = $_REQUEST["file"];
//    $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]) . "/testpage/botanicni3";   // temporary fix
    $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
    $imgToDelete = $base_dir . $imgPath;

    if (file_exists($imgToDelete)) {
        unlink($imgToDelete);
        echo 'File '.$imgToDelete.' has been deleted';
    } else {
        echo 'Could not delete ' . $base_dir . ' in ' . $imgPath . ', file does not exist';
    }
}