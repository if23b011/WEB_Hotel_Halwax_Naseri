<div class="container" style="margin-bottom: 100px;">
    <?php
    //? serverseitige Validierung
    require_once 'utils/dbaccess.php';
    require_once 'utils/functions.php';
    if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) {
        header("Location: index.php?page=profile");
        exit();
    }
    $gender = $email = $firstname = $lastname = $password = $password2 = $date = "";
    $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $password2Err = $dateErr = "";
    $passwordErrSec = "Das Passwort muss 8 Zeichen lang sein und mindestens: 
    1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl und 1 Sonderzeichen enthalten";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["gender"])) {
            $gender = input($_POST["gender"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "*erforderlich";
        } else {
            $email = input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Das ist keine richtige Email-Adresse";
                $email = "";
            }
        }

        if (empty($_POST["firstname"])) {
            $firstnameErr = "*erforderlich";
        } else {
            $firstname = input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Zäöü]*$/", $firstname)) {
                $firstnameErr = "Das ist kein richtiger Vorname";
                $firstname = "";
            }
        }

        if (empty($_POST["lastname"])) {
            $lastnameErr = "*erforderlich";
        } else {
            $lastname = input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Zäöü]*$/", $lastname)) {
                $lastnameErr = "Das ist kein richtiger Nachname";
                $lastname = "";
            }
        }

        if (empty($_POST["date"])) {
            $dateErr = "*erforderlich";
        } else {
            $date = input($_POST["date"]);
        }

        if (empty($_POST["password"])) {
            $passwordErr = "*erforderlich";
        } else {
            $password = input($_POST["password"]);
        }

        //? Passwortvalidierung
        if (empty($_POST["password"])) {
            $passwordErr = "*erforderlich";
        } else {
            $password = input($_POST["password"]);
        }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (
            !(empty($_POST["password"])) && (strlen($password) < 8 || !$uppercase || !$lowercase
                || !$number || !$specialChars)
        ) {
            $passwordErrSec = "Das Passwort muss 8 Zeichen lang sein und mindestens: 
            1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl und 1 Sonderzeichen enthalten!";
            $password = "";
        } else {
            $passwordErrSec = "";
        }

        if (empty($_POST["password2"])) {
            $password2Err = "*erforderlich";
            $password2 = "";
        } else if ($_POST['password'] != $_POST['password2']) {
            $password2Err = "Passwort ist nicht ident!";
            $password2 = "";
        } else {
            $password2 = input($_POST["password2"]);
        }
    }
    if (
        $gender != "" && $email != "" && $firstname != "" && $lastname != "" && $password != "" &&
        $password2 != "" && $emailErr == "" && $firstnameErr == "" && $lastnameErr == "" &&
        $passwordErr == "" && $password2Err == "" && $passwordErrSec == ""
    ) {
        //? Daten in Datenbank speichern
        if (emailExists($conn, $_POST["email"])) {
            header("Location: index.php?page=registerNtf&error=emailExists");
        } else {

            if ($_POST["gender"] == "Herr") {
                $dBgender = "M";
            } else {
                $dBgender = "W";
            }

            $birth = input($_POST["date"]);
            $birthDate = date("d.m.Y", strtotime($birth));
            createUser($conn, $dBgender, $firstname, $lastname, $birthDate, $email, $password, "user");
        }
    }

    function createUser($conn, $gender, $firstname, $lastname, $birthdate, $email, $password, $type)
    {
        $sql = "INSERT INTO users ( gender, firstname, lastname, birthdate, email, password, type) 
                                VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
            <p>SQL statement failed";</p>
            <?php return;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $birthdate = date("Y-m-d", strtotime($birthdate));
        mysqli_stmt_bind_param($stmt, "sssssss", $gender, $firstname, $lastname, $birthdate, $email, $hashedPassword, $type);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION["email"] = $email;
        header("Location: index.php?page=loginNtf&error=none");
    }
    ?>
    <!-- Formular -->
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 50rem;">
        <div style="text-align: center;">
            <h1>Registrierung</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=register"); ?>">
                <p class="text-center">Bereits registriert?</p>
                <a href="index.php?page=login" class="mb-3 a-glow">
                    <span></span>
                    Zum Login
                </a>
                <div class="row">
                    <div class="mb-5 d-flex justify-content-center align-items-center">
                        <div class="col-12 col-md-6 d-flex align-items-center form-group">
                            <select class="form-select" name="gender" id="gender"
                                style="background-color: #000; color: #fff; text-align: center;">
                                <option <?php if (isset($gender) && $gender == "Herr")
                                    echo "selected"; ?> value="Herr">
                                    Herr</option>
                                <option <?php if (isset($gender) && $gender == "Frau")
                                    echo "selected"; ?> value="Frau">
                                    Frau</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="text" name="firstname" value="<?php echo $firstname ?>"
                            placeholder="<?php echo $firstnameErr ?>" tabindex="1">
                        <label>Vorname*</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="text" name="lastname" value="<?php echo $lastname ?>"
                            placeholder="<?php echo $lastnameErr ?>" tabindex="2">
                        <label>Nachname*</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="date" name="date" value="<?php echo $date ?>" placeholder="<?php echo $dateErr ?>"
                            tabindex="3">
                        <label>Geburtsdatum*</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="text" name="email" value="<?php echo $email ?>"
                            placeholder="<?php echo $emailErr ?>" tabindex="4">
                        <label>E-Mail*</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="password" name="password" value="<?php echo $password ?>"
                            placeholder="<?php echo $passwordErr ?>" tabindex="5">
                        <label>Passwort*</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="password" name="password2" value="<?php echo $password2 ?>"
                            placeholder="<?php echo $password2Err ?>" tabindex="6">
                        <label>Passwort wiederholen*</label>
                    </div>
                    <p style="color: red" class="text-center">
                        <?php echo $passwordErrSec ?>
                    </p>
                </div>
                <p style="color: red" class="text-start">*erforderlich</p>
                <input type="submit" value="Register" class="loginBoxSubmit">
            </form>
        </div>
    </div>
</div>