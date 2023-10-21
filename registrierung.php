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
        <!-- serverseitige Validierung -->
        <?php
        $anrede = $email = $firstname = $lastname = $password = $password2 = $date = "";
        $anredeErr = $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $password2Err = $dateErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["anrede"])) {
                $anredeErr = "Anrede ist erforderlich";
            } else {
                $anrede = test_input($_POST["anrede"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email ist erforderlich";
            } else {
                $email = test_input($_POST["email"]);
                //TODO: E-Mail-Adresse überprüfen funktioniert nicht mit Modal
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            if (empty($_POST["firstname"])) {
                $firstnameErr = "Vorname ist erforderlich";
            } else {
                $firstname = test_input($_POST["firstname"]);
                if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
                    $firstnameErr = "Das ist kein richtiger Vorname";
                }
            }

            if (empty($_POST["lastname"])) {
                $lastnameErr = "Nachname ist erforderlich";
            } else {
                $lastname = test_input($_POST["lastname"]);
                if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
                    $lastnameErr = "Das ist kein richtiger Nachname";
                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Passwort ist erforderlich";
            } else {
                $password = test_input($_POST["password"]);
            }

            if (empty($_POST["password2"])) {
                $password2Err = "Passwortwiederholung ist erforderlich";
            } else {
                $password2 = test_input($_POST["password2"]);
            }

            if (empty($_POST["date"])) {
                $dateErr = "Geburtsdatum ist erforderlich";
            } else {
                $date = test_input($_POST["date"]);
            }
        }

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <!-- Formular -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="mb-3">
                    <span class="error">
                        <p style="color: red;">
                            <?php echo "*" . $anredeErr; ?>
                        </p>
                    </span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="anrede">
                        <p>Herr</p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="anrede">
                        <p>Frau</p>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 align-items-start">
                    <div class="col">
                        <div class=" mb-3">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "*" . $firstnameErr; ?>
                                </p>
                            </span>
                            <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                                value="<?php echo $firstname; ?>">
                        </div>
                        <div class="mb-3">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "*" . $dateErr; ?>
                                </p>
                            </span>
                            <input type="date" class="form-control" name="date" tabindex="3"
                                value="<?php echo $date; ?>">
                        </div>
                        <div class="mb-3">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "*" . $passwordErr; ?>
                                </p>
                            </span>
                            <input type="password" class="form-control" name="password" placeholder="Passwort"
                                tabindex="5" value="<?php echo $password; ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "*" . $lastnameErr; ?>
                                </p>
                            </span>
                            <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                                value="<?php echo $lastname; ?>">
                        </div>
                        <div class="mb-3">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "*" . $emailErr; ?>
                                </p>
                            </span>
                            <input type="email" class="form-control" name="email" placeholder="E-Mail-Adresse"
                                tabindex="4" value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <span class="error">
                                <p style="color: red;">
                                    <?php echo "*" . $password2Err; ?>
                                </p>
                            </span>
                            <input type="password" class="form-control" name="password2"
                                placeholder="Passwort wiederholen" tabindex="6" value="<?php echo $password2; ?>">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <input class="btn btn-primary" type="submit" value="Submit" tabindex="7" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                </div>
            </div>
        </form>
    </div>
    <!-- TODO: Modal hinzufügen -->

    <!-- Footer-->
    <?php include 'footer.php'; ?>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 style="color: black;" class="modal-title fs-5" id="staticBackdropLabel">Registrierung
                        erfolgreich</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="color: black;">Herzlich Willkommen
                        <?php echo $_POST["firstname"] . " " . $_POST["lastname"]; ?><br>
                        Du hast einen Bestätigungscode auf deine Email (
                        <?php echo $_POST["email"]; ?>) erhalten.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Verstanden</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>