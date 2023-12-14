<div class="container" style="margin-bottom: 100px;">
    <h1>Profil</h1>
    <?php
    $firstname = $lastname = $email = $date = $password = "";
    $passwordErr = $passwordErrUp = $passwordErrLow = $passwordErrNum = $passwordErrSpecial = $passwordErrLen =
        $passwordErrIdent = $wrongOldPassword = "";
    require_once 'utils/dbaccess.php';
    $_SESSION["email"] = $_COOKIE["email"];
    $sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
    $result = mysqli_query($conn, $sql);
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
        /*if (isset($_POST["email"])) {
            $email = input($_POST["email"]);
        }*/
        if (isset($_POST["date"])) {
            $date = input($_POST["date"]);
        }
        $birthDate = date("Y-m-d", strtotime($date));

        $sql = "UPDATE users SET firstname = ? , lastname = ? , birthdate = ? WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL-Fehler";
            return;
        }
        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $birthDate, $_SESSION["email"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        //? Passwortvalidierung
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
            $sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
            $result = mysqli_query($conn, $sql);
            if (!password_verify($_POST['oldPassword'], $row['password'])) {
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
    <div class="container">
        <div class="d-grid gap-3 col-md-6 mx-auto">
            <a class="btn btn-info" role="button" href="index.php?page=reservations">Meine Reservierungen</a>";
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="d-grid gap-3 col-md-6 mx-auto">
                <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                    value="<?php echo $firstname; ?>">
                <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                    value="<?php echo $lastname; ?>">
                <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" tabindex="3"
                    value="<?php echo $email; ?>" disabled>
                <input type="date" class="form-control" name="date" tabindex="4" value="<?php echo $date; ?>">
                <input class="btn btn-primary" type="submit" value="Änderungen übernehmen" tabindex="5">
                <p>Passwort ändern:</p>
            </div>

        </form>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="d-grid gap-3 col-md-6 mx-auto">
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
                    $sql = "SELECT * FROM users WHERE email = '" . $_SESSION["email"] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (
                        ($_POST["newPassword"] == $_POST["newPassword2"]) && password_verify($_POST['oldPassword'], $row['password']) &&
                        ($passwordErr == "") && ($passwordErrUp == "") && ($passwordErrLow == "") && ($passwordErrNum == "") &&
                        ($passwordErrSpecial == "") && ($passwordErrLen == "") && ($passwordErrIdent == "") && ($wrongOldPassword == "")
                    ) {
                        $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                        $sql = "UPDATE users SET password = ? WHERE email = ?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL-Fehler";
                            return;
                        }
                        mysqli_stmt_bind_param($stmt, "ss", $password, $_SESSION["email"]);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        echo '<div class="alert alert-success" role="alert">
                            Passwort erfolgreich geändert!
                            </div>';
                    }
                }
                ?>
                <input class="btn btn-warning" type="submit" value="Passwort ändern" tabindex="8">
                <?php
                if (isset($_COOKIE["email"])) {
                    echo '<a class="btn btn-danger" role="button" href="utils/logout.php">Logout</a>"';
                }
                ?>
            </div>
        </form>
    </div>
</div>