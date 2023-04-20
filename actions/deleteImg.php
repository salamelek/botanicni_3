<?php
if (array_key_exists('file', $_REQUEST)) {
    $imgToDelete = $_REQUEST["file"];
    // REMOVE THAT SHITTY LOVALHOST:// BLAH BLAH BALH
    if (file_exists($imgToDelete)) {
        unlink($imgToDelete);
        echo 'File '.$imgToDelete.' has been deleted';
    } else {
        echo 'Could not delete '.$imgToDelete.', file does not exist';
    }
}