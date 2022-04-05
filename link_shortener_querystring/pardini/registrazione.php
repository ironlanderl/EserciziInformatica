<?php

include_once "dbUtils.php";

// Start the session
session_start();

//Check if logged in
if ($_SESSION) {
    // Redirect
    header("Location: index.php");
}



?>
<!DOCTYPE html>
<html>


<script>
    function validateForm() {
        let x = document.forms["register"]["password"].value;
        if (x.length < 8 || x.length > 32) {
            alert("La password deve essere tra gli 8 e i 32 caratteri");
            return false;
        }
        return true;
        // regex checks
        /*let regex = /[A-Z]+/g;
        if (regex.test(x)) {
            regex = /[a-z]+/g;
            if (regex.test(x)) {
                regex = /[0-9]/g;
                if (regex.test(x)) {} else {
                    alert("La password deve contenere almeno un numero");
                    return false;
                }
            } else {
                alert("La password deve contenere almeno una lettera minuscola");
                return false;
            }
        } else {
            alert("La password deve contenere almeno una lettera maiuscola");
            return false;
        }*/
    }
</script>

<body>
    <?php
    // Controllo se è presente una richiesta post
    if ($_POST) {
        // Prendo il nome utente e password dalla richiesta
        $username = $_POST["username"];
        $password = $_POST["password"];

        $conn = connetti();

        // Calcolo l'hash della password
        $hashPass = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users VALUES ('" . htmlspecialchars($username) . "', '" . $hashPass . "');";

        if (mysqli_query($conn, $query)) {
            echo "Utente registrato con successo";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        disconnetti($conn);
    }

    StampaForm();
    // Stampo il warning per ricordare l'utente di modificare il file
    echo '
    <div class="alert alert-danger fade show container">
        <strong>Attenzione! </strong> Ricordarsi di modificare il file .htaccess presente nella root.
    </div>
    ';
    function StampaForm()
    {
        echo
        '<div class="modal modal-signin position-static d-block py-5" tabindex="-1" role="dialog" id="modalSignin" onsubmit="return validateForm()">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-5 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h2 class="fw-bold mb-0">Registrati</h2>
                    </div>
                    <div class="modal-body p-5 pt-0">
                        <form class="" action=' . $_SERVER["PHP_SELF"] . ' method="post" name="register" >
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-4" id="floatingInput" placeholder="username" name="username" required>
                                <label for="floatingInput">Nome Utente</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-4" id="floatingPassword" placeholder="Password" name="password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Registrati</button>
                            <a class="btn btn-primary" href="login.php">⬅Login</a>
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