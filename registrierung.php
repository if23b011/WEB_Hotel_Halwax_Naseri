<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Registrierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include 'navbar.php'; ?>
    <!-- Content-->
    <!--TODO: Für Handy anpassen-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Registrierung</h1>
        <?php
        //serverseitige Validierung
        $anrede = $email = $firstname = $lastname = $password = $password2 = $date = "";
        $anredeErr = $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $passwordErrUp = $passwordErrLow = $passwordErrNum = $passwordErrSpecial = $passwordErrLen = $password2Err = $dateErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["anrede"])) {
                $anredeErr = "Anrede ist erforderlich";
            } else {
                $anrede = input($_POST["anrede"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email ist erforderlich";
            } else {
                $email = input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            if (empty($_POST["firstname"])) {
                $firstnameErr = "Vorname ist erforderlich";
            } else {
                $firstname = input($_POST["firstname"]);
                if (!preg_match("/^[a-zA-Zäöü]*$/", $firstname)) {
                    $firstnameErr = "Das ist kein richtiger Vorname";
                }
            }

            if (empty($_POST["lastname"])) {
                $lastnameErr = "Nachname ist erforderlich";
            } else {
                $lastname = input($_POST["lastname"]);
                if (!preg_match("/^[a-zA-Zäöü]*$/", $lastname)) {
                    $lastnameErr = "Das ist kein richtiger Nachname";
                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Passwort ist erforderlich";
            } else {
                $password = input($_POST["password"]);
            }

            //Passwortvalidierung
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if (!$uppercase) {
                $passwordErrUp = "min. einen Großbuchstaben";
            }


            if (!$lowercase) {
                $passwordErrLow = "min. einen Kleinbuchstaben";
            }

            if (!$number) {
                $passwordErrNum = "min. eine Zahl";
            }

            if (!$specialChars) {
                $passwordErrSpecial = "min. ein Sonderzeichen";
            }

            if (strlen($password) < 8) {
                $passwordErrLen = "min. 8 Zeichen lang";
            }

            if (empty($_POST["password2"])) {
                $password2Err = "Passwortwiederholung ist erforderlich";
            } else if ($_POST['password'] != $_POST['password2']) {
                $password2Err = "Passwort ist nicht ident!";
            } else {
                $password2 = input($_POST["password2"]);
            }



            if (empty($_POST["date"])) {
                $dateErr = "Geburtsdatum ist erforderlich";
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
        ?>
        <!-- Formular -->
        <!-- TODO: Formatierung der Registrierung mit "*erforderlich" -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="mb-3">
                    <span class="error">
                        <p style="color: red;">
                            <?php echo "" . $anredeErr; ?>
                        </p>
                    </span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="anrede" <?php if (isset($anrede) && $anrede == "herr")
                            echo "checked"; ?> value="herr">
                        <p>Herr</p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="anrede" <?php if (isset($anrede) && $anrede == "frau")
                            echo "checked"; ?> value="frau">
                        <p>Frau</p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 align-items-start">
                    <div class="col">
                        <div class=" mb-3">
                            <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                                value="<?php echo $firstname; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $firstnameErr; ?>
                                </p>
                            </span>
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control" name="date" tabindex="3"
                                value="<?php echo $date; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $dateErr; ?>
                                </p>
                            </span>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Passwort"
                                tabindex="5" value="<?php echo $password; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $passwordErr; ?>
                                </p>
                            </span>
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $passwordErrUp; ?>
                                </p>
                            </span>
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $passwordErrLow; ?>
                                </p>
                            </span>
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $passwordErrNum; ?>
                                </p>
                            </span>
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $passwordErrSpecial; ?>
                                </p>
                            </span>
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $passwordErrLen; ?>
                                </p>
                            </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="emails" class="form-control" name="lastname" placeholder="Nachname"
                                tabindex="2" value="<?php echo $lastname; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $lastnameErr; ?>
                                </p>
                            </span>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse"
                                tabindex="4" value="<?php echo $email; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $emailErr; ?>
                                </p>
                            </span>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password2"
                                placeholder="Passwort wiederholen" tabindex="6" value="<?php echo $password2; ?>">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "" . $password2Err; ?>
                                </p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <input class="btn btn-primary" type="submit" value="Submit" tabindex="7">
                </div>
                <h2>
                    <?php
                    if (
                        isset($_POST['anrede']) && isset($_POST['email']) && isset($_POST['firstname'])
                        && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['password2'])
                        && isset($_POST['date']) && ($_POST['password'] == $_POST['password2'])
                    ) {
                        echo "Herzlich Willkommen " . $_POST["firstname"] . " " . $_POST["lastname"] . ".<br>"
                            . "Du hast einen Bestätigungscode auf deine Email (" . $_POST["email"] . ") erhalten.";
                    }
                    ?>
                </h2>
            </div>
        </form>
    </div>
    <!-- TODO: Modal hinzufügen -->
    <!-- Footer-->
    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>