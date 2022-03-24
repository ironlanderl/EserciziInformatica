<?php
require("dbUtils.php");

if ($_GET){
    $url = $_GET["a"];
    $conn = connetti();
    $q = "SELECT original FROM urls WHERE shorter = '" . $url . "'";
    $result = mysqli_query($conn, $q);
    // Aggiorno le visite
    $q2 = "UPDATE urls SET visits = visits + 1 WHERE shorter = '" . $url . "'";
    mysqli_query($conn, $q2);
    // Vado al sito
    $row = mysqli_fetch_assoc($result);
    header("Location: " . $row["original"]);
}







?>