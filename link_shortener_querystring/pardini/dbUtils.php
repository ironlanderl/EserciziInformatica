<?php
    function connetti(){
        $dbServer = "localhost";
        $dbUser = "root";
        $dbPass = "root";
        $dbName = "esshortener_querystring_pardini";

        $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
        // Controllo della connessione
        if (!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        else{
            return $conn;
        }
    }

    function disconnetti(mysqli $a){
        mysqli_close($a);
    }


?>