<div class="container" style="margin-bottom: 100px;">
    <h1>Login</h1>
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
        <?php } ?>
        <div class="d-grid mx-auto mt-4">
            <div class="text-center">
                <?php
                require_once 'utils/functions.php';
                //? serverseitige Validierung
                $email = $password = "";
                $emailErr = $passwordErr = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["email"])) {
                        $emailErr = "*erforderlich";
                    } else {
                        $email = input($_POST["email"]);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Das ist keine richtige Email-Adresse";
                        }
                    }

                    if (empty($_POST["password"])) {
                        $passwordErr = "*erforderlich";
                    } else {
                        $password = input($_POST["password"]);
                    }
                }
                //? Daten mit Datenbank vergleichen
                require_once 'utils/functions.php';
                loginUser($conn, $email, $password);
                ?>
            </div>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=login"); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <?php if (!isset($_GET["register"])) { ?>
                            <div class="mb-3">
                                <p class="text-center">Noch nicht registriert? <a href="index.php?page=register">Zur
                                        Registrierung</a></p>
                            </div>
                        <?php } ?>
                        <div class="mb-1">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse"
                                value="<?php echo $email; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php
                                    if ($emailErr != "") {
                                        echo $emailErr;
                                    } else if (empty($_POST['email'])) {
                                        echo "*";
                                    } else {
                                        echo "⠀";
                                    } ?>
                            </span>
                        </div>
                        <div class="mb-1">
                            <input data-toggle="password" class="form-control" type="password" name="password"
                                placeholder="Passwort">
                            <span class="error">
                                <p style="color: red;">
                                    <?php
                                    if ($passwordErr != "") {
                                        echo $passwordErr;
                                    } else if (empty($_POST['password'])) {
                                        echo "*";
                                    } else {
                                        echo "⠀";
                                    } ?>
                                </p>
                            </span>
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>