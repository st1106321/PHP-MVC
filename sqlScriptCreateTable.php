<?php

/* db variables */
$servername = "localhost"; // example : '127.0.1.1'
$username = "user2";
$password = "";
$dbname = "php-db2";

/* Create connection */
$conn = new mysqli($servername, $username, $password, $dbname);
/* Check connection */
if ($conn->connect_error) {
    die("Connection failed: <br/>" . $conn->connect_error);
}

/* drop table for testing */
$sql = "DROP TABLE users, aliments, specifics, aliments_specifics, users_aliments;";
echo ($conn->query($sql) === TRUE) ? "Drop tables executed successfully<br/>" : "Could not drop the tables: {$conn->error}<br/>";

/* Create user table */
$sql = "CREATE TABLE users (
    id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name varchar(64),
    honour int(2),
    pswd varchar(128),
    email varchar(50) NOT NULL UNIQUE,
    regDate TIMESTAMP
);";

/* Check if there is no errors */
echo ($conn->query($sql) === TRUE) ? "Table 'users' created successfully<br/>" : "Error 'users' creating table: {$conn->error}<br/>";

/* Create aliments table */
$sql = "CREATE TABLE aliments (
    id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name varchar(64) NOT NULL UNIQUE,
    kcal float(6),
    proteins float(6),
    lipids float(6),
    carbohydrate float(6),
    fibers float(6),
    CONSTRAINT CHK_Float CHECK (kcal >= 0 AND proteins >= 0 AND lipids >= 0 AND carbohydrate >= 0 AND fibers >= 0)
);";

echo ($conn->query($sql) === TRUE) ? "Table 'aliments' created successfully<br/>" : "Error 'aliments' creating table: {$conn->error}<br/>";

/* Create specifics table */
$sql = "CREATE TABLE specifics (
    id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name varchar(64)
);";

echo ($conn->query($sql) === TRUE) ? "Table 'specifics' created successfully<br/>" : "Error 'specifics' creating table: {$conn->error}<br/>";

/* Create users_aliments table */
$sql = "CREATE TABLE users_aliments (
    user_id int REFERENCES users,
    aliment_id int REFERENCES aliments,
    up_date TIMESTAMP
);";

echo ($conn->query($sql) === TRUE) ? "Table 'users_aliments' created successfully<br/>" : "Error 'users_aliments' creating table: {$conn->error}<br/>";

/* Create aliments_specifics table */
$sql = "CREATE TABLE aliments_specifics (
    aliment_id int REFERENCES aliments,
    specific_id int REFERENCES specifics
);";

echo ($conn->query($sql) === TRUE) ? "Table 'aliments_specifics' created successfully<br/>" : "Error 'aliments_specifics' creating table: {$conn->error}<br/>";

$conn->close();


