<?php
// 192.168.56.56 or 127.0.0.1 or 192.168.56.0
//$servername = '192.168.56.0';
$servername = '192.168.56.56';
$username = 'homestead';
$password = 'secret';
$dbname = "botanicniDB";
$port = 3306;


try {
    $conn = new mysqli($servername, $username, $password, null, $port);

    if ($conn->connect_error) {
        die('Could not Connect MySql Server: ' . $conn->error);
    }
    $conn->select_db($dbname);
    // FIXME throws error 1064 (create table Plants)
//    create_db($conn);
} catch (PDOException $e) {
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
    } else if ($e->getCode() == 2002) {
        die("Can't connect to the server... goodbye");
    } else {
        die("A mysql error occurred: " . $e->getCode());
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

function is_admin($username): bool {
    global $conn;

    $sql = "select isAdmin from Users
        where username = '$username';
    ";

    $result = mysqli_query($conn, $sql) or die("cannot see if user is admin");
    $rows = mysqli_fetch_assoc($result);
    return $rows["isAdmin"];
}

function get_plant_assoc($plantLatName=null, $plantId=null): ?array {
    global $conn;

    $sql = "select * from Plants
        where imeLat = '$plantLatName'
        or id = '$plantId';
    ";

    $result = mysqli_query($conn, $sql) or die("cannot get plant data");
    if (mysqli_num_rows($result)) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}


/**
 * @param $usr
 * @param $psw
 * @return bool
 * 
 * Checks if a pair of username and password checks out
 */
function check_credentials($usr, $psw): bool {
    global $conn;

    $sql = "
        SELECT * 
        FROM Users 
        WHERE username= '$usr' 
        AND pswHash= '" . md5($psw) . "';
    ";
    $result = mysqli_query($conn, $sql) or die("error while checking credentials");

    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}


function add_or_edit_plant($plantAssoc): void {
    global $conn;

    $sql = "
        SELECT id
        FROM Plants
        WHERE id = '" . $plantAssoc["oldId"] . "'
    ";
    $result = mysqli_query($conn, $sql) or die("could not fetch plant data");

    if (mysqli_num_rows($result) == 0) {
        $sql = "
            INSERT INTO Plants (imeLat, imeSlo, imeIta, drugaImenaSlo, sorta, druzina, izvor, habitat, opis, zanimivosti, isAtSchool)
            VALUES ('" . $plantAssoc["imeLat"] . "', '" . $plantAssoc["imeSlo"] . "', '" . $plantAssoc["imeIta"] . "', '" . $plantAssoc["drugaImenaSlo"] . "', '" . $plantAssoc["sorta"] . "', '" . $plantAssoc["druzina"] . "', '" . $plantAssoc["izvor"] . "', '" . $plantAssoc["habitat"] . "', '" . $plantAssoc["opis"] . "', '" . $plantAssoc["zanimivosti"] . "', '" . $plantAssoc["isAtSchool"] . "')
        ";
    } else if (mysqli_num_rows($result) == 1) {
        $sql = "
            UPDATE Plants
            SET 
                imeLat =        '" . $plantAssoc["imeLat"] . "', 
                imeSlo =        '" . $plantAssoc["imeSlo"] . "',
                imeIta =        '" . $plantAssoc["imeIta"] . "', 
                drugaImenaSlo = '" . $plantAssoc["drugaImenaSlo"] . "',
                sorta =         '" . $plantAssoc["sorta"] . "',
                druzina =       '" . $plantAssoc["druzina"] . "', 
                izvor =         '" . $plantAssoc["izvor"] . "',
                habitat =       '" . $plantAssoc["habitat"] . "',
                opis =          '" . $plantAssoc["opis"] . "',
                zanimivosti =   '" . $plantAssoc["zanimivosti"] . "',
                viri =          '" . $plantAssoc["viri"] . "',
                isAtSchool =    '" . $plantAssoc["isAtSchool"] . "'
            WHERE id = '" . $plantAssoc["oldId"] . "'
        ";
    } else {
        trigger_error("ayo wtf");
        exit();
    }

    mysqli_query($conn, $sql) or die("Prišlo je do napake dodajanja podatkov rastline");
}


function get_n_plants($n, $offset): array {
    // FIXME since this function is thrash and it will be replaced, make sure to replace it in a way that works for searching too (./modules/search_plant.php)

    global $conn;

    $sql = "
        SELECT imeLat
        FROM Plants
        LIMIT $n
        OFFSET $offset;
    ";

    $result = mysqli_query($conn, $sql);
    $rows = array();

    // Loop through the result set and add each row to the array
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row["imeLat"];
    }

    return $rows;
}


function delete_plant($imeLat=null, $id=null): void {
    global $conn;

    $sql = "
        DELETE FROM Plants
        WHERE imeLat = '$imeLat'
        OR id = '$id';
    ";

    mysqli_query($conn, $sql) or die("could not delete plant");

    // delete images folder
    $dirPath = "./images/plants/" . $imeLat;

    array_map('unlink', glob("$dirPath/*.*"));
    rmdir($dirPath);
}


function get_n_plants_new($num, $offset, $searchByLang, $onlyAtSchool, $orderBy, $like) {
    // TODO this is a draft for the improved list in list.php

    global $conn;

    $sql = "
        SELECT imeLat, imeSlo, imeIta, drugaImenaSlo
        FROM Plants
        WHERE (isAtSchool IS TRUE
            OR isAtSchool IS $onlyAtSchool)
            AND $searchByLang LIKE $like
        ORDER BY $searchByLang $orderBy
        LIMIT $num
            OFFSET $offset;
    ";

}