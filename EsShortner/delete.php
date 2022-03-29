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
        printf("Devi prima loggarti\nVerrai reindirizzato in 5 secondi.");
    }
}







?>
<script>
    var timer = 5; 
var counter;
 
function startTimer() {
	counter = setInterval(countDown, 1000);
}
 
function countDown() {
	var display = document.getElementById("timer");
	display.innerHTML = timer;
 
 
	timer--;
 
	if (timer < 0) {
		clearInterval(counter);
 
		window.location.href = "login.php";
	}
}		
 
startTimer();	
</script>