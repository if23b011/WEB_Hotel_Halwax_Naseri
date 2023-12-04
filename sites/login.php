<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php'; ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Login</h1>
        <div class="d-grid mx-auto mt-4">
            <div class="text-center">
                <?php
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

                function input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                //Daten mit Datenbank vergleichen
                require_once '../utils/dbaccess.php';
                function emailExists($conn, $email)
                {
                    require_once '../utils/dbaccess.php';
                    $sql = "SELECT * FROM users WHERE email = ?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL-Fehler";
                        return;
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
                    mysqli_stmt_close($stmt);
                }
                function loginUser($conn, $email, $password)
                {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Assuming you have form fields named "email" and "password"
                        $email = input($_POST["email"]);
                        $password = input($_POST["password"]);

                        // Validate the email and password
                        if (!empty($email) && !empty($password)) {
                            // Check if the user exists in the database
                            $userData = emailExists($conn, $email);

                            if ($userData) {
                                // Verify the password
                                if (password_verify($password, $userData['password'])) {
                                    // Password is correct
                                    $_SESSION['login'] = true;
                                    setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
                                    //Datenbankabfrage
                                    $sql = "SELECT * FROM users WHERE email = '$email'";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    if ($row['gender'] == 'M') {
                                        $gender = 'Herr';
                                    } else {
                                        $gender = 'Frau';
                                    }
                                    if ($row['type'] == 'admin') {
                                        $_SESSION['admin'] = true;
                                        setcookie("admin", true, time() + (86400 * 30), "/");
                                        echo '<h3>Willkommen zurück Admin!</h3>';
                                        echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                                    } else {
                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        echo '<h3>Willkommen zurück ' . $gender . " " . $firstname . " " . $lastname . '!</h3>';
                                        echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                                    }
                                } else {
                                    // Incorrect password
                                    echo '<p style="color: red;">Falsches Passwort!</p>';
                                }
                            } else {
                                // User does not exist
                                echo '<p style="color: red;">Benutzer existiert nicht!</p>';
                            }
                        }
                    }
                }
                loginUser($conn, $email, $password);
                /*if ($email == 'admin@gmail.com') {
                    $_SESSION['login'] = true;
                    $_SESSION['admin'] = true;
                    echo '<h3>Willkommen ' . $_SESSION['firstname'] . '!</h3>';
                    echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                } else if ($email == $_SESSION['email'] && $password == $_SESSION['password'] && isset($_POST["email"]) && isset($_POST["password"])) {
                    $_SESSION['login'] = true;
                    echo '<h3>Willkommen zurück ' . $_SESSION['gender'] . ' ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '!</h3>';
                    echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                } else if (isset($_POST["email"]) && isset($_POST["password"])) {
                    echo '<h3 style="color: red;">Du bist noch nicht registriert!</h3>';
                    echo "<a class='btn btn-primary' role='button' href='../sites/registrierung.php'<h2>Zur Registrierung</h2></a>";
                }
                */
                ?>
            </div>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="text-center">Noch nicht registriert? <a href="../sites/registrierung.php">Zur
                                    Registrierung</a></p>
                        </div>
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
                        <?php
                        if (isset($_GET["newpwd"])) {
                            if ($_GET["newpwd"] == "passwordupdated") {
                                echo '<p class="text-success">Your password has been reset!</p>';
                            }
                        }
                        ?>
                        <div class="mb-3">
                            <p class="text-center"><a href="../sites/resetpassword.php">Passwort vergessen?</a></p>
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>