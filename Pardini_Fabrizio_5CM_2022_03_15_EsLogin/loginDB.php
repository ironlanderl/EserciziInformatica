<?php
// Start the session
session_start();

//Check if logged in
if ($_SESSION){
    // Redirect
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>

<body>
    <?php
    // Controllo se è presente una richiesta post
    if ($_POST) {
        // Prendo il nome utente e password dalla richiesta
        $username = $_POST["username"];
        $password = $_POST["password"];

        /* Parte del login al DB */
        $dbServer = "localhost";
        $dbUser = "root";
        $dbPass = "root";
        $dbName = "esercizio2";
        $conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);
        // Controllo della connessione
        if (!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        /**********************************/

        // Calcolo l'hash della password
        $hashPass = md5($password);

        $query = "SELECT * FROM users WHERE username = '" . htmlspecialchars($username) . "' AND password = '" . $hashPass . "';";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0){
            // È presente un elemento 
            $_SESSION["user"] = $username;
            header("Location: index.php");
            return;
        }
        echo "Nome utente o password errati";

        // Check del nome utente
        //if ($username == "Fabrizio") {
        //    // Hash della password
        //    if (md5($password) == "5f4dcc3b5aa765d61d8327deb882cf99" /* Hash di 'password' */) {
        //        echo "Benvenuto " . $_POST["username"];
        //        return;
        //    }
        //}
        
    }

    StampaForm();

    
    function StampaForm()
    {
        echo
        '<div class="modal modal-signin position-static d-block py-5" tabindex="-1" role="dialog" id="modalSignin">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-5 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Login</h2>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form class="" action=' . $_SERVER["PHP_SELF"] . ' method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-4" id="floatingInput" placeholder="username" name="username" required>
                                <label for="floatingInput">Nome Utente</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password" name="password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Login</button>
                            <a class="btn btn-primary" href="registrazioneDB.php">Registrati➡</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>';
    }
    ?>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>