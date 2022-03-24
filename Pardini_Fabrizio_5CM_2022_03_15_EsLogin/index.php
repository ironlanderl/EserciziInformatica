<?php
// Start the session
session_start();

// 1 ora
$time = time() + 3600;

// Controllo se non esiste la sessione
if (!$_SESSION) {
    // Redirect al login
    header('Location: loginDB.php');
    exit;
}

// Crea il cookie
if (!isset($_COOKIE['visite'])) {
    setcookie('visite', 1, $time);
}
?>


<html>

<body>
    <?php
    // Aumento le visite
    $visite = $_COOKIE["visite"] + 1;
    echo "Bentornato " . $_SESSION["user"] . "<br>";
    echo "Visite attuali = " . $visite . "<br>";
    setcookie("visite", $visite, $time);



    ?>
</body>

</html>