<?php
// 192.168.56.56 or 127.0.0.1 or 192.168.56.0
$servername = '192.168.56.0';
$username = 'homestead';
$password = 'secret';
$dbname = "botanicniDB";
$port = 3306;

$conn = new mysqli($servername, $username, $password, null, $port);

if ($conn->connect_error) {
    die('Could not Connect MySql Server: ' . $conn->error);
}

try {
    $conn->select_db($dbname);
    create_db($conn);
} catch (Exception $e) {
    // error code 1049 stands for "unknown database"
    if ($e->getCode() == 1049) {
        $sql = "CREATE DATABASE " . $dbname;
        if (mysqli_query($conn, $sql)) {
            // connect to the newly created database
            $conn->select_db($dbname);
            create_db($conn);
        } else {
            die("Unable to create new database.");
        }
    }
}

function create_db($conn): void {
    try {
        // the icon value will be a combinations of the icons (like the discord system)
        $conn->query("
            CREATE TABLE IF NOT EXISTS Plants (
            id int primary key auto_increment,
            imeLat char(255) not null,
            imeSlo char(255),
            imeIta char(255),
            drugaImenaSlo text,
            sorta char(255),
            druzina char(255),
            izvor text,
            habitat text,
            opis text,
            zanimivosti text,
            isAtSchool bool,
            iconsCode int not null,
            unique key (imeLat)
        );");

        $conn->query("
            CREATE TABLE IF NOT EXISTS Users (
            id int primary key auto_increment,
            username char(255) not null,
            pswHash char(255) not null,
            isAdmin bool not null
        );");

    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }
}