<div class="container" style="margin-bottom: 100px;">
    <?php
    //? serverseitige Validierung
    require_once 'utils/dbaccess.php';
    require_once 'utils/functions.php';
    $gender = $email = $firstname = $lastname = $password = $password2 = $date = "";
    $genderErr = $emailErr = $firstnameErr = $lastnameErr = $passwordErr = $passwordErrUp =
        $passwordErrLow = $passwordErrNum = $passwordErrSpecial = $passwordErrLen = $password2Err = $dateErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["gender"])) {
            $gender = input($_POST["gender"]);
        }

        if (empty($_POST["email"])) {
            $email = "*erforderlich";
        } else {
            $email = input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = "Das ist keine richtige Email-Adresse";
            }
        }

        if (empty($_POST["firstname"])) {
            $firstname = "*erforderlich";
        } else {
            $firstname = input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Zäöü]*$/", $firstname)) {
                $firstname = "Das ist kein richtiger Vorname";
            }
        }

        if (empty($_POST["lastname"])) {
            $lastname = "*erforderlich";
        } else {
            $lastname = input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Zäöü]*$/", $lastname)) {
                $lastname = "Das ist kein richtiger Nachname";
            }
        }

        if (empty($_POST["password"])) {
            $password = "*erforderlich";
        } else {
            $password = input($_POST["password"]);
        }

        //? Passwortvalidierung
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (strlen($password) < 8 && !(empty($_POST["password"]))) {
            $password = "*erforderlich:";
            $password = "8 Zeichen";
        }

        if (!$uppercase && !(empty($_POST["password"]))) {
            $password = "*erforderlich:";
            $password = "1 Großbuchstabe";
        }

        if (!$lowercase && !(empty($_POST["password"]))) {
            $password = "*erforderlich:";
            $password = "1 Kleinbuchstabe";
        }

        if (!$number && !(empty($_POST["password"]))) {
            $password = "*erforderlich:";
            $password = "1 Zahl";
        }

        if (!$specialChars && !(empty($_POST["password"]))) {
            $password = "*erforderlich:";
            $password = "1 Sonderzeichen";
        }

        if (empty($_POST["password2"])) {
            $password2 = "*erforderlich";
        } else if ($_POST['password'] != $_POST['password2']) {
            $password2 = "Passwort ist nicht ident!";
        } else {
            $password2 = input($_POST["password2"]);
        }

        if (empty($_POST["date"])) {
            $date = "*erforderlich";
        } else {
            $date = input($_POST["date"]);
        }
    }
    //FIXME
    if ($allesOK) {
        //? Daten in Datenbank speichern
        require_once 'utils/dbaccess.php';
        if (registerEmailExists($conn, $_POST["email"])) {
            header("Location: index.php?page=registerNtf&error=emailExists");
        } else {

            if ($_POST["gender"] == "Herr") {
                $dBgender = "M";
            } else {
                $dBgender = "W";
            }

            $birth = input($_POST["date"]);
            $birthDate = date("d.m.Y", strtotime($birth));
            createUser($conn, $dBgender, $_POST["firstname"], $_POST["lastname"], $birthDate, $_POST["email"], $_POST["password"], "user");
        }
    }

    function createUser($conn, $gender, $firstname, $lastname, $birthdate, $email, $password, $type)
    {
        require_once 'utils/dbaccess.php';
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
                        <input type="text" name="firstname" value="<?php echo $firstname ?>" tabindex="1">
                        <label>Vorname</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="text" name="lastname" value="<?php echo $lastname ?>" tabindex="2">
                        <label>Nachname</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="date" name="date" value="<?php echo $date ?>" tabindex="3">
                        <label>Geburtsdatum</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="text" name="email" value="<?php echo $email ?>" tabindex="4">
                        <label>E-Mail</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input data-toggle="password" type="password" name="password" value="<?php echo $password ?>" tabindex="5">
                        <label>Passwort</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input data-toggle="password" type="password" name="password2" value="<?php echo $password2 ?>" tabindex="6">
                        <label>Passwort wiederholen</label>
                    </div>
                </div>
                <input type="submit" value="Register" class="loginBoxSubmit">
            </form>
        </div>
    </div>
</div>