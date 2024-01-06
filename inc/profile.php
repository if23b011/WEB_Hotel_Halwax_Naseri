<div class="container" style="margin-bottom: 100px;">
    <?php
    $firstname = $lastname = $email = $date = $oldPassword = $password = $password2 = "";
    $oldPasswordErr = $passwordErr = $password2Err = $newPasswordErr = "";
    $passwordErrSec = "Das neue Passwort muss 8 Zeichen lang sein und mindestens: 
    1 Großbuchstabe, 1 Kleinbuchstabe, 1 Zahl und 1 Sonderzeichen enthalten";
    require_once 'utils/dbaccess.php';
    require_once 'utils/functions.php';

    $sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $firstname = input($row['firstname']);
    $lastname = input($row['lastname']);
    $email = input($row['email']);
    $date = input($row['birthdate']);
    $birthDate = date("Y-m-d", strtotime($date));
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["firstname"])) {
            $firstname = input($_POST["firstname"]);
        }
        if (isset($_POST["lastname"])) {
            $lastname = input($_POST["lastname"]);
        }
        if (isset($_POST["date"])) {
            $date = input($_POST["date"]);
        }
        $birthDate = date("Y-m-d", strtotime($date));

        $sql = "UPDATE users SET firstname = ? , lastname = ? , birthdate = ? WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landingNtf&error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $birthDate, $_SESSION["email"]);
        mysqli_stmt_execute($stmt);


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
            $passwordErrSec = "Das neue Passwort muss 8 Zeichen lang sein und mindestens: 
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
        if (!empty($_POST["oldPassword"])) {
            $sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?page=landingNtf&error=stmtFailed");
                exit();
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (!password_verify($_POST['oldPassword'], $row['password'])) {
                $oldPasswordErr = "Falsches Passwort!";
                $oldPassword = "";
            } else {
                $oldPassword = input($_POST["oldPassword"]);
            }
        } else {
            $oldPasswordErr = "*erforderlich";
            $oldPassword = "";
        }

        if ($password == $row['password']) {
            $newPasswordErr = "Das neue Passwort darf nicht dem alten Passwort entsprechen!";
        }
    }
    if (isset($_POST["password"])) {
        $sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landingNtf&error=stmtFailed");
            exit();
        }
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (
            ($password != "") && ($password2 != "") && ($oldPassword != "") &&
            ($password == $password2) && password_verify($oldPassword, $row['password']) &&
            ($passwordErr == "") && ($passwordErrSec == "") && ($password2Err == "") &&
            ($oldPasswordErr == "") && ($password != $row['password'])
        ) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?page=landingNtf&error=stmtFailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "ss", $password, $_SESSION["email"]);
            mysqli_stmt_execute($stmt);
            ?>
            <?php
            header("Location: index.php?page=profileNtf&error=nonePassword");
        }
    }
    ?>
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 42rem;">
        <div style="text-align: center;">
            <h1>Profil</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=profile"); ?>">
            <?php //FIXME: Wenn Admin keine Reservierungen hat scheißt er rein mal wieder ?>
                <a href="index.php?page=reservations" class="mb-3 a-glow">
                    <span></span>
                    Meine Reservierungen
                </a>
                <div class="user-box">
                    <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                        value="<?php echo $firstname; ?>">
                    <label>Vorname</label>
                </div>
                <div class="user-box">
                    <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                        value="<?php echo $lastname; ?>">
                    <label>Nachname</label>
                </div>
                <div class="user-box">
                    <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="3"
                        value="<?php echo $email; ?>" disabled>
                    <label>E-Mail-Adresse</label>
                </div>
                <div class="user-box">
                    <input type="date" class="form-control" name="date" tabindex="4" value="<?php echo $date; ?>">
                    <label>Geburtstag</label>
                </div>
                <input type="submit" value="Änderungen übernehmen" class="loginBoxSubmit" tabindex="5">
            </form>
        </div>
    </div>
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 42rem;">
        <div style="text-align: center;">
            <h1>Passwort ändern:</h1>
            <p class="mb-5" style="color: red" class="text-center">
                <?php echo $passwordErrSec ?>
            </p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=profile"); ?>">
                <div class="user-box">
                    <input type="password" name="oldPassword" value="<?php echo $oldPassword ?>"
                        placeholder="<?php echo $oldPasswordErr ?>" tabindex="6">
                    <label>Altes Passwort*</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" value="<?php echo $password ?>"
                        placeholder="<?php echo $passwordErr ?>" tabindex="7">
                    <label>Neues Passwort*</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password2" value="<?php echo $password2 ?>"
                        placeholder="<?php echo $password2Err ?>" tabindex="8">
                    <label>Neues Passwort wiederholen*</label>
                </div>
                <p style="color: red" class="text-center">
                    <?php echo $newPasswordErr ?>
                </p>
                <p style="color: red" class="text-start">*erforderlich</p>
                <input type="submit" value="Passwort ändern" class="loginBoxSubmit" tabindex="8">
            </form>
        </div>
    </div>
    <?php
    if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) { ?>
        <div class="d-grid gap-3 col-6 mx-auto">
            <a class="btn btn-danger" role="button" href="utils/logout.php">Logout</a>
        </div>
    <?php }
    ?>
</div>