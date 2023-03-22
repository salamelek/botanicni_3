<?php
// https://www.w3schools.com/php/php_file_upload.asp
// https://www.tutorialspoint.com/how-to-upload-multiple-files-and-store-them-in-a-folder-with-php

$images_path = "./images/plants/";
$plant = "test plant 2";


// create directory
if (!file_exists(($images_path . $plant))) {
    mkdir($images_path . $plant);
}


