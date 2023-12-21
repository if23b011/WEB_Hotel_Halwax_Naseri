<div class="container" style="margin-bottom: 100px;">
    <?php
    if (isset($_GET["register"]) && $_GET["register"] == "success") { ?>´
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        <p style="color: black">Registrierung erfolgreich! Bitte melden Sie sich an!</p>
                    </div>
                </div>
            </div>
            <?php
    } ?>
        <div class="d-grid mx-auto mt-4 text-center">
            <h3 style="color: red;">
                <?php
                require_once 'utils/functions.php';
                require_once 'utils/dbaccess.php';
                //? serverseitige Validierung
                $email = $password = "";
                $emailErr = $passwordErr = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["email"])) {
                        $emailErr = "Email erforderlich";
                    } else {
                        $email = input($_POST["email"]);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Das ist keine richtige Email-Adresse";
                        }
                    }
                    if (empty($_POST["password"])) {
                        $passwordErr = "Passwort erforderlich";
                    } else {
                        $password = input($_POST["password"]);
                    }
                }
                //? Daten mit Datenbank vergleichen
                if (empty($emailErr) && empty($passwordErr)) {
                    loginUser($conn, $email, $password);
                }
                echo $emailErr . "<br>";
                echo $passwordErr;
                ?>
            </h3>
        </div>
    </div>
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 42rem;">
        <div style="text-align: center;">
            <h1>Login</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=login"); ?>">
                <?php if (!isset($_GET["register"])) { ?>
                    <p class="text-center">Noch nicht registriert?</p>
                    <a href="index.php?page=register" class="mb-3">
                        <span></span>
                        Zur Registrierung
                    </a>
                <?php } ?>
                <div class="user-box">
                    <input type="text" name="email" required>
                    <label>E-Mail</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" required>
                    <label>Passwort</label>
                </div>
                <input type="submit" value="Login" class="loginBoxSubmit">
            </form>
        </div>
    </div>
</div>