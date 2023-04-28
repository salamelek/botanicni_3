<?php
if (array_key_exists('file', $_REQUEST)) {
    $imgPath = $_REQUEST["file"];
    $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
    $imgToDelete = $base_dir . $imgPath;

    if (file_exists($imgToDelete)) {
        unlink($imgToDelete);
        echo 'File '.$imgToDelete.' has been deleted';
    } else {
        echo 'Could not delete ' . $imgToDelete . ', file does not exist';
    }
}