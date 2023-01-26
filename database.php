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
            create table if not exists Icons
            (
                id              int auto_increment
                    primary key,
                iconPath        char(255) not null,
                iconDescription text      not null
            );
            
            create table if not exists Plants
            (
                id            int auto_increment
                    primary key,
                imeLat        char(255)  not null,
                imeSlo        char(255)  null,
                imeIta        char(255)  null,
                drugaImenaSlo text       null,
                sorta         char(255)  not null,
                druzina       char(255)  not null,
                izvor         text       null,
                habitat       text       null,
                opis          text       null,
                zanimivosti   text       null,
                isAtSchool    tinyint(1) not null,
                constraint imeLat
                    unique (imeLat)
            );
            
            create table if not exists `Plants-Icons`
            (
                plantId int not null,
                iconId  int not null,
                constraint plantIcons_pk
                    unique (plantId, iconId),
                constraint plantIcons_Icons_id_fk
                    foreign key (plantId) references Icons (id)
                        on update cascade on delete cascade,
                constraint plantIcons_Plants_id_fk
                    foreign key (plantId) references Plants (id)
                        on update cascade on delete cascade
            );
            
            create table if not exists Podrocja
            (
                id                  int auto_increment
                    primary key,
                namePodrocje        char(255) not null,
                descriptionPodrocje text      null,
                constraint namePodrocje
                    unique (namePodrocje)
            );
            
            create table if not exists `Podrocja-Plants`
            (
                podrocjeId int not null,
                plantId    int not null,
                constraint `Podrocja-Plants_pk`
                    unique (podrocjeId, plantId),
                constraint `Podrocja-Plants_Plants_id_fk`
                    foreign key (plantId) references Plants (id)
                        on update cascade on delete cascade,
                constraint `Podrocja-Plants_Podrocja_id_fk`
                    foreign key (podrocjeId) references Podrocja (id)
                        on update cascade on delete cascade
            );
            
            create table if not exists Users
            (
                id       int auto_increment
                    primary key,
                username char(255)  not null,
                pswHash  char(255)  not null,
                isAdmin  tinyint(1) not null,
                constraint username
                    unique (username)
            );
        ");

    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }
}