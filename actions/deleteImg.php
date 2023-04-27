<?php
if (array_key_exists('file', $_REQUEST)) {
    $imgToDelete = $_REQUEST["file"];
    echo unlink($imgToDelete);
    if (file_exists($imgToDelete)) {
        unlink($imgToDelete);
        echo 'File '.$imgToDelete.' has been deleted';
    } else {
        echo 'Could not delete ' . $imgToDelete . ', file does not exist';
    }
}