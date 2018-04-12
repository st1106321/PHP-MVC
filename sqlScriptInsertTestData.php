<?php

/* db variables */
$servername = "127.0.0.1:50426";
$dbname = "localdb";
$username = "azure";
$password ="6#vWHD_$";

/* Create connection */
$conn = new mysqli($servername, $username, $password, $dbname);
/* Check connection */
if ($conn->connect_error) {
    die("Connection failed: <br/>" . $conn->connect_error);
}

/* set some test data for aliments in arrays */
$nameArr = ["banana", "apple", "raspberry", "garlic"];
$kcalArr = [93.6, 54, 45.1, 131];
$proteinsArr = [1.2, 0.3, 1.4, 7];
$lipidsArr = [0.2, 0.4, 0.3, 0];
$carbohydrateArr = [20.5, 12.6, 4.25, 21];
$fibersArr = [2.8, 2.5, 6.7, 4];

/* prepare and bind for multiple insertions */
$stmt = $conn->prepare("INSERT INTO aliments(name, kcal, proteins, lipids, carbohydrate, fibers) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sddddd", $name, $kcal, $proteins, $lipids, $carbohydrate, $fibers);

/* loop through the arrays and execute the statement */
for ($i = 0, $len = sizeof($nameArr); $i < $len; $i++) {
    $name = $nameArr[$i];
    $kcal = $kcalArr[$i];
    $proteins = $proteinsArr[$i];
    $lipids = $lipidsArr[$i];
    $carbohydrate = $carbohydrateArr[$i];
    $fibers = $fibersArr[$i];

    $stmt->execute();    
}

echo "New records created successfully";

/* Close statement */
$stmt->close();
/* Close connection */
$conn->close();