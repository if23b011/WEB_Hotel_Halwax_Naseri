<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Registrierung</title>
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
        <h1>Registrierung</h1>
        <div class="d-grid mx-auto">
            <div class="text-center">
                <?php
                //serverseitige Validierung
                $gender = $email = $firstname = $lastname = $password = $password2 = $date = "";
                $genderErr = $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $passwordErrUp =
                    $passwordErrLow = $passwordErrNum = $passwordErrSpecial = $passwordErrLen = $password2Err = $dateErr = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["gender"])) {
                        $genderErr = "*erforderlich";
                    } else {
                        $gender = input($_POST["gender"]);
                    }

                    if (empty($_POST["email"])) {
                        $emailErr = "*Email ist erforderlich";
                    } else {
                        $email = input($_POST["email"]);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Das ist keine richtige Email-Adresse";
                        }
                    }

                    if (empty($_POST["firstname"])) {
                        $firstnameErr = "*erforderlich";
                    } else {
                        $firstname = input($_POST["firstname"]);
                        if (!preg_match("/^[a-zA-Zäöü]*$/", $firstname)) {
                            $firstnameErr = "Das ist kein richtiger Vorname";
                        }
                    }

                    if (empty($_POST["lastname"])) {
                        $lastnameErr = "*erforderlich";
                    } else {
                        $lastname = input($_POST["lastname"]);
                        if (!preg_match("/^[a-zA-Zäöü]*$/", $lastname)) {
                            $lastnameErr = "Das ist kein richtiger Nachname";
                        }
                    }

                    if (empty($_POST["password"])) {
                        $passwordErr = "*erforderlich";
                    } else {
                        $password = input($_POST["password"]);
                    }

                    //Passwortvalidierung
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);
                    $specialChars = preg_match('@[^\w]@', $password);

                    if (strlen($password) < 8 && !(empty($_POST["password"]))) {
                        $passwordErr = "*erforderlich:";
                        $passwordErrLen = "8 Zeichen";
                    }

                    if (!$uppercase && !(empty($_POST["password"]))) {
                        $passwordErr = "*erforderlich:";
                        $passwordErrUp = "1 Großbuchstabe";
                    }

                    if (!$lowercase && !(empty($_POST["password"]))) {
                        $passwordErr = "*erforderlich:";
                        $passwordErrLow = "1 Kleinbuchstabe";
                    }

                    if (!$number && !(empty($_POST["password"]))) {
                        $passwordErr = "*erforderlich:";
                        $passwordErrNum = "1 Zahl";
                    }

                    if (!$specialChars && !(empty($_POST["password"]))) {
                        $passwordErr = "*erforderlich:";
                        $passwordErrSpecial = "1 Sonderzeichen";
                    }

                    if (empty($_POST["password2"])) {
                        $password2Err = "*erforderlich";
                    } else if ($_POST['password'] != $_POST['password2']) {
                        $password2Err = "Passwort ist nicht ident!";
                    } else {
                        $password2 = input($_POST["password2"]);
                    }

                    if (empty($_POST["date"])) {
                        $dateErr = "*erforderlich";
                    } else {
                        $date = input($_POST["date"]);
                    }
                }

                function input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if (
                    $genderErr == "" && $emailErr == "" && $firstnameErr == "" && $lastnameErr == "" && $passwordErr == "" &&
                    $password2Err == "" && $dateErr == "" && $passwordErrUp == "" && $passwordErrLow == "" &&
                    $passwordErrNum == "" && $passwordErrSpecial == "" && $passwordErrLen == "" && $gender != ""
                ) {
                    //Daten in Datenbank speichern
                    require_once '../utils/dbaccess.php';

                    if (emailExists($conn, $_POST["email"])) {
                        echo "<p style='color: red;'>Diese E-Mail-Adresse ist bereits registriert!</p>";
                        exit();
                    }

                    if ($_POST["gender"] == "Herr") {
                        $dBgender = "M";
                    } else {
                        $dBgender = "W";
                    }

                    $birth = input($_POST["date"]);
                    $birthDate = date("d.m.Y", strtotime($birth));
                    createUser($conn, $dBgender, $_POST["firstname"], $_POST["lastname"], $birthDate, $_POST["email"], $_POST["password"], "user");
                    setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
                }
                function emailExists($conn, $email)
                {
                    require_once '../utils/dbaccess.php';
                    $sql = "SELECT * FROM users WHERE email = ?;";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL-Fehler";
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
                function createUser($conn, $gender, $firstname, $lastname, $birthdate, $email, $password, $type)
                {
                    require_once '../utils/dbaccess.php';
                    $sql = "INSERT INTO users (userId, gender, firstname, lastname, birthdate, email, password, type) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statement failed";
                        return;
                    }

                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $birthdate = date("Y-m-d", strtotime($birthdate));
                    mysqli_stmt_bind_param($stmt, "sssssss", $gender, $firstname, $lastname, $birthdate, $email, $hashedPassword, $type);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    echo "<h3>Herzlich Willkommen " . $_POST["gender"] . " " . $_POST["firstname"] . " " . $_POST["lastname"] . "!</h3><br>";
                    echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                    $_SESSION["login"] = true;
                }
                ?>
            </div>
        </div>
        <!-- Formular -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="mb-3">
                    <p>Schon registriert? <a href="../sites/login.php">Zum Login</a></p>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "Herr")
                            echo "checked"; ?> value="Herr">
                        <p>Herr</p>
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "Frau")
                        echo "checked"; ?> value="Frau">
                    <p>Frau</p>
                </div>
                <span class="error">
                    <p style="color: red;">
                        <?php
                        if ($genderErr != "") {
                            echo $genderErr;
                        } else if (empty($_POST['gender'])) {
                            echo "*";
                        } else {
                            echo "⠀";
                        } ?>
                    </p>
                </span>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                            value="<?php echo $firstname; ?>">
                        <span class="error">
                            <p style="color: red;">
                                <?php
                                if ($firstnameErr != "") {
                                    echo $firstnameErr;
                                } else if (empty($_POST['firstname'])) {
                                    echo "*";
                                } else {
                                    echo "⠀";
                                } ?>
                            </p>
                        </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                            value="<?php echo $lastname; ?>">
                        <span class="error">
                            <p style="color: red;">
                                <?php
                                if ($lastnameErr != "") {
                                    echo $lastnameErr;
                                } else if (empty($_POST['lastname'])) {
                                    echo "*";
                                } else {
                                    echo "⠀";
                                } ?>
                            </p>
                        </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="date" class="form-control" name="date" tabindex="3" value="<?php echo $date; ?>">
                        <span class="error">
                            <p style="color: red;">
                                <?php
                                if ($dateErr != "") {
                                    echo $dateErr;
                                } else if (empty($_POST['date'])) {
                                    echo "*";
                                } else {
                                    echo "⠀";
                                } ?>
                            </p>
                        </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="4"
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
                    <div class="col-md-6 mb-3">
                        <input data-toggle="password" class="form-control" type="password" name="password"
                            placeholder="Passwort" tabindex="5">
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
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErrUp; ?>
                            </p>
                        </span>
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErrLow; ?>
                            </p>
                        </span>
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErrNum; ?>
                            </p>
                        </span>
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErrSpecial; ?>
                            </p>
                        </span>
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErrLen; ?>
                            </p>
                        </span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input data-toggle="password" class="form-control" type="password" name="password2"
                            placeholder="Passwort wiederholen" tabindex="5">
                        <span class="error">
                            <p style="color: red;">
                                <?php
                                if ($password2Err != "") {
                                    echo $password2Err;
                                } else if (empty($_POST['password2'])) {
                                    echo "*";
                                } else {
                                    echo "⠀";
                                } ?>
                            </p>
                        </span>
                    </div>
                </div>
                <div class="d-grid mx-auto text-center"> <!-- Add 'text-center' class here -->
                    <input class="btn btn-primary" type="submit" value="Submit" tabindex="7">
                </div>
            </div>
            <p style="color: red;">
                <?php
                if (
                    $genderErr != "" || $emailErr != "" || $firstnameErr != "" || $lastnameErr != "" || $passwordErr != ""
                    || $password2Err != "" || $dateErr != ""
                ) {
                    echo "⠀";
                } else if (
                    isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['firstname'])
                    && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['password2'])
                    && isset($_POST['date']) && ($_POST['password'] == $_POST['password2']) && $passwordErrUp == ""
                    && $passwordErrLow == "" && $passwordErrNum == "" && $passwordErrSpecial == "" && $passwordErrLen == ""
                ) {
                    echo "";
                } else {
                    echo "*erforderlich";
                } ?>
            </p>
        </form>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>