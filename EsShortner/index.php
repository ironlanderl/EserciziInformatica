<?php

require("dbUtils.php");

// Start the session
session_start();

// Controllo se non esiste la sessione
if (!$_SESSION) {
    // Redirect al login
    header('Location: login.php');
    exit;
}

// Controllo per post
if ($_POST){
    $conn = connetti();

    // Estraggo l'url
    $url = $_POST["url"];
    // Estraggo il nome utente
    $user = $_SESSION["user"];

    // Calcolo un codice casuale
    $shorter = randomString(10);
    // Controllo se esiste
    $q = "SELECT * FROM urls WHERE shorter = '" . $shorter . "'";
    $result = mysqli_query($conn, $q);
    // Loop per controllare se esiste già un url accorciato
    while (mysqli_num_rows($result) > 0){
        // Calcolo un nuovo codice casuale
        $shorter = randomString(10);
        // Controllo se esiste
        $result = mysqli_query($conn, $q);
    }

    // Inserisco il nuovo url
    $q = "INSERT INTO urls (original, shorter, insertedby) VALUES ('" . $url . "', '" . $shorter . "', '" . $user . "')";

    if (!mysqli_query($conn, $q)){
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }

    disconnetti($conn);
    
    

}






function randomString(int $lenght){
    $chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    $string = "";
    for ($i = 0; $i < $lenght; $i++){
        $rng = random_int(0, count($chars));
        $string = $string . $chars[$rng];
    }
    return $string;
}

?>


<html>

<head>
    <script>
        function validateForm() {
            let x = document.forms["shortener"]["url"].value;
            let url;

            try {
                url = new URL(x);
            } catch (_) {
                alert("URL NON VALIDO");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>

    <div class="container">
        <form onclick="<?php echo $_SERVER["PHP_SELF"] ?>" onsubmit="return validateForm()" name="shortener" method="POST">
            <div class="input-group mb-3 mt-3">
                <input type="text" class="form-control" placeholder="Url da accorciare" aria-label="Url da accorciare" aria-describedby="basic-addon2" required name="url">
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Url Originale</th>
                    <th scope="col">Url Corto</th>
                    <th scope="col">Visite</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $conn = connetti();
                $username = $_SESSION["user"];

                // Query per prendere gli url inseriti dall'utente
                $q = "SELECT * FROM urls WHERE insertedby = '" . $username . "'";

                // eseguo
                $result = mysqli_query($conn, $q);

                // stampo
                while($row = mysqli_fetch_assoc($result)) {
                    $urlo = $row["original"];
                    $urls = "http://localhost/Esercizi/EsShortner/r.php?a=" . $row["shorter"];
                    echo "<tr>";
                    echo "<td><a href='" . $urlo . "'>" . $urlo . "</a></td>";
                    echo "<td><a href='" . $urls . "'>" . $urls . "</a></td>";
                    echo "<td>" . $row["visits"] . "</td>";
                    echo "</tr>";
                }


                ?>
            </tbody>


        </table>








    </div>



    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>