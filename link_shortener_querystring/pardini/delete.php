<?php
session_start();
include_once "dbUtils.php";

if ($_GET){
    $url = $_GET["a"];
    $username = $_SESSION["user"];
    $conn = connetti();
    /* Controllo se l'utente che sta eliminando l'URL è lo stesso che lo ha inserito */
    $result = $conn->query("SELECT * FROM urls WHERE shorter = '" . $url . "' AND insertedby = '" . $username . "'");
    // Se è presente un risultato
    if ($result->num_rows >= 1){
        // Elimino l'url
        $q = "DELETE FROM urls WHERE shorter = '" . $url . "'";
        $result = mysqli_query($conn, $q);
        header("Location: index.php");
    }
    else{
        echo "Devi prima loggarti<br>";
        echo "Verrai reindirizzato in 5 secondi.";
        header('refresh:5; url=login.php');
    }
}