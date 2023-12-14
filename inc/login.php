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
                //? serverseitige Validierung
                $email = $password = "";
                $emailErr = $passwordErr = "";
                if (isset($_SESSION["email"])) {
                    $email = $_SESSION["email"];
                }
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

                function input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                //? Daten mit Datenbank vergleichen
                require_once 'utils/dbaccess.php';
                function emailExists($conn, $email)
                {
                    require_once 'utils/dbaccess.php';
                    $sql = "SELECT * FROM users WHERE email = ?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                        <p>SQL-Fehler</p>
                        <?php return;
                    }

                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);

                    $resultData = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($resultData)) {
                        return $row;
                    } else {
                        $result = false;
                        return $result;
                    }
                }
                function loginUser($conn, $email, $password)
                {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $email = input($_POST["email"]);
                        $password = input($_POST["password"]);

                        //?  Validate the email and password
                        if (!empty($email) && !empty($password)) {
                            //?  Check if the user exists in the database
                            $userData = emailExists($conn, $email);

                            if ($userData) {
                                //?  Verify the password
                                if (password_verify($password, $userData['password'])) {
                                    //?  Password is correct
                                    $_SESSION['login'] = true;
                                    setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
                                    //? Datenbankabfrage
                                    $sql = "SELECT * FROM users WHERE email = '$email'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row['type'] == 'admin') {
                                        $_SESSION['admin'] = true;
                                        setcookie("admin", true, time() + (86400 * 30), "/");
                                        header("Location: index.php");
                                    } else {
                                        header("Location: index.php");
                                    }
                                } else { ?>
                                    <p style="color: red;">Falsches Passwort!</p>
                                <?php }
                            } else { ?>
                                //? User does not exist
                                <p style="color: red;">Benutzer existiert nicht!</p>
                            <?php }
                        }
                    }
                }
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