<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Profil</h1>
        <?php
        $firstname = $lastname = $email = $date = $password = "";
        $passwordErr = $passwordErrUp = $passwordErrLow = $passwordErrNum = $passwordErrSpecial = $passwordErrLen =
            $passwordErrIdent = $wrongOldPassword = "";
        if (isset($_SESSION["firstname"])) {
            $firstname = input($_SESSION["firstname"]);
        } else {
            $firstname = "Max";
        }
        if (isset($_SESSION["lastname"])) {
            $lastname = input($_SESSION["lastname"]);
        } else {
            $lastname = "Mustermann";
        }
        if (isset($_SESSION["email"])) {
            $email = input($_SESSION["email"]);
        } else {
            $email = "max.mustermann@email.com";
        }
        if (isset($_SESSION["date"])) {
            $date = input($_SESSION["date"]);
        } else {
            $date = "2000-01-01";
        }
        $newDate = date("Y-m-d", strtotime($date));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["firstname"])) {
                $firstname = input($_POST["firstname"]);
            }
            if (isset($_POST["lastname"])) {
                $lastname = input($_POST["lastname"]);
            }
            if (isset($_POST["email"])) {
                $email = input($_POST["email"]);
            }
            if (isset($_POST["date"])) {
                $date = input($_POST["date"]);
            }
            $newDate = date("Y-m-d", strtotime($date));
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            $_SESSION["email"] = $email;
            $_SESSION["date"] = $date;

            //Passwortvalidierung
            if (isset($_POST["newPassword"])) {
                $password = input($_POST["newPassword"]);
            }

            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if (strlen($password) < 8 && !(empty($_POST["newPassword"]))) {
                $passwordErr = "*erforderlich:";
                $passwordErrLen = "8 Zeichen";
            }

            if (!$uppercase && !(empty($_POST["newPassword"]))) {
                $passwordErr = "*erforderlich:";
                $passwordErrUp = "1 Großbuchstabe";
            }

            if (!$lowercase && !(empty($_POST["newPassword"]))) {
                $passwordErr = "*erforderlich:";
                $passwordErrLow = "1 Kleinbuchstabe";
            }

            if (!$number && !(empty($_POST["newPassword"]))) {
                $passwordErr = "*erforderlich:";
                $passwordErrNum = "1 Zahl";
            }

            if (!$specialChars && !(empty($_POST["newPassword"]))) {
                $passwordErr = "*erforderlich:";
                $passwordErrSpecial = "1 Sonderzeichen";
            }
            if (isset($_POST["newPassword"])) {
                if ($_POST["newPassword"] != $_POST["newPassword2"]) {
                    $passwordErrIdent = "Passwörter stimmen nicht überein!";
                }
            }

            if (isset($_POST["oldPassword"])) {
                if ($_POST["oldPassword"] != $_SESSION["password"]) {
                    $wrongOldPassword = "Falsches Passwort!";
                }
            }
        }
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="d-grid gap-3 col-6 mx-auto">
                    <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                        value="<?php echo $firstname; ?>">
                    <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                        value="<?php echo $lastname; ?>">
                    <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="3"
                        value="<?php echo $email; ?>">
                    <input type="date" class="form-control" name="date" tabindex="4" value="<?php echo $newDate; ?>">
                    <input class="btn btn-primary" type="submit" value="Änderungen übernehmen" tabindex="4">
                    <p>Passwort ändern:</p>
                </div>
            </div>
        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="d-grid gap-3 col-6 mx-auto">
                    <input data-toggle="password" class="form-control" type="password" name="oldPassword"
                        placeholder="Altes Passwort" tabindex="5">
                    <div class="mb-3">
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $wrongOldPassword; ?>
                            </p>
                        </span>
                    </div>
                    <input data-toggle="password" class="form-control" type="password" name="newPassword"
                        placeholder="Neues Passwort" tabindex="6">
                    <input data-toggle="password" class="form-control" type="password" name="newPassword2"
                        placeholder="Neues Passwort wiederholen" tabindex="7">
                    <div class="mb-3">
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErrIdent; ?>
                            </p>
                        </span>
                        <span class="error">
                            <p style="color: red;">
                                <?php echo $passwordErr; ?>
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
                    <?php
                    if (isset($_POST["newPassword"])) {
                        if (
                            ($_POST["newPassword"] == $_POST["newPassword2"]) && ($_POST["oldPassword"] == $_SESSION["password"]) &&
                            ($passwordErr == "") && ($passwordErrUp == "") && ($passwordErrLow == "") && ($passwordErrNum == "") &&
                            ($passwordErrSpecial == "") && ($passwordErrLen == "") && ($passwordErrIdent == "") && ($wrongOldPassword == "")
                        ) {
                            $_SESSION["password"] = $_POST["newPassword"];
                            echo '<div class="alert alert-success" role="alert">
                    Passwort erfolgreich geändert!
                    </div>';
                        }
                    }
                    ?>
                    <input class="btn btn-danger" type="submit" value="Passwort ändern" tabindex="8">
                </div>
            </div>
        </form>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>