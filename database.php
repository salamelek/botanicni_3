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
        $sql = "create database " . $dbname;
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
    $sql1 = "create table if not exists Plants (
        id int primary key auto_increment,
        nameLat char(255) not null,
        nameSlo char(255),
        nameIta char(255),
        climaticZone char(255),
        isAtSchool bool,
        unique key (nameLat)
    );";

    $sql2 = "create table if not exists Users (
        id int primary key auto_increment,
        username char(255) not null,
        pswHash char(255) not null,
        isAdmin bool not null
    )
    ";

    if (!$conn->query($sql1)) {
        echo "Error creating table 1: " . $conn->error . "<br>";
    }
}