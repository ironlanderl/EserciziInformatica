<?php

include_once "dbUtils.php";

// Start the session
session_start();

// Controllo se non esiste la sessione
if (!$_SESSION) {
    // Redirect al login
    header('Location: login.php');
    exit;
}

// Controllo per post
if ($_POST) {
    $conn = connetti();

    // Estraggo l'url
    $url = $_POST["url"];
    // Estraggo il nome utente
    $user = $_SESSION["user"];

    // Se l'url non è valido avverto l'utente ed interrompo l'esecuzione
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        http_response_code(400);
        echo "URL INVALIDO";
    }

    // Calcolo un codice casuale
    $shorter = randomString(10);
    // Controllo se esiste
    $q = "SELECT * FROM urls WHERE shorter = '" . $shorter . "'";
    $result = mysqli_query($conn, $q);
    // Loop per controllare se esiste già un url accorciato
    while (mysqli_num_rows($result) > 0) {
        // Calcolo un nuovo codice casuale
        $shorter = randomString(10);
        // Controllo se esiste
        $result = mysqli_query($conn, $q);
    }

    // Inserisco il nuovo url
    $q = "INSERT INTO urls (original, shorter, insertedby) VALUES ('" . $url . "', '" . $shorter . "', '" . $user . "')";

    if (!mysqli_query($conn, $q)) {
        http_response_code(400);
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }
    http_response_code(201);
    disconnetti($conn);
}





/** */
function randomString(int $lenght)
{
    $chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
    $string = "";
    for ($i = 0; $i < $lenght; $i++) {
        $rng = random_int(0, count($chars));
        $string = $string . $chars[$rng];
    }
    return $string;
}

?>


<html>

<head>
</head>

<body>

    <div class="container">
        <!-------------------------------------------------->
        <header class="p-3 mb-3 border-bottom">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start pr-3">

                <ul class="nav nav-pills col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ml-3">

                    <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Home</a></li>
                </ul>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        Logged in as <?php echo $_SESSION["user"]; ?>
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <!-------------------------------------------------->
        <form onclick="<?php echo $_SERVER["PHP_SELF"] ?>" name="shortener" method="POST">
            <div class="input-group mb-3 mt-3">
                <input type="url" class="form-control" placeholder="Url da accorciare" aria-label="Url da accorciare" aria-describedby="basic-addon2" required name="url">
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Url Originale</th>
                    <th scope="col">Url Corto</th>
                    <th scope="col">Visite</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php
                $conn = connetti();
                $username = $_SESSION["user"];

                // Query per prendere gli url inseriti dall'utente
                $q = "SELECT * FROM urls WHERE insertedby = '" . $username . "' ORDER BY visits DESC;";

                // eseguo
                $result = $conn->query($q);

                // stampo
                while ($row = mysqli_fetch_assoc($result)) {
                    $urloLenght = strlen($row["original"]);
                    $urlo = $row["original"];
                    $urls = "r?a=" . $row["shorter"];
                    $urld = "delete.php?a=" . $row["shorter"];
                    echo "<tr>";
                    // Se l'url originale è più lungo di 50 caratteri lo tronco
                    if ($urloLenght > 50){
                        echo "<td><a href={$urlo}>" . mb_strimwidth($urlo, 0, 50) . "...</a></td>";
                    }
                    else{
                        echo "<td><a href={$urlo}>{$urlo}</a></td>";
                    }
                    
                    echo "<td><a href={$urls}>{$urls}</a></td>";
                    echo "<td>" . $row["visits"] . "</td>";
                    echo "<td><a class='btn btn-danger' href='{$urld}'>Elimina</a></td>";
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