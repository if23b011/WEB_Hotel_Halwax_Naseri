<?php
//Error handling
if (isset($_GET['error'])) {
    if ($_GET['error'] == "noneRegister") { ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Registrierung erfolgreich! Bitte loggen Sie sich ein.
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    } else if ($_GET['error'] == "wrongPassword") { ?>
            <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Falsches Passwort
                </div>
                <div class="warning__progress"></div>
            </div>
        <?php
    } else if ($_GET['error'] == "wrongEmail") { ?>
                <div class="warning">
                    <div class="warning__body">
                        <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                        Benutzer existiert nicht
                    </div>
                    <div class="warning__progress"></div>
                </div>
        <?php
    } else if ($_GET['error'] == "notActive") { ?>
                    <div class="warning">
                        <div class="warning__body">
                            <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                            Benutzer ist nicht aktiviert
                        </div>
                        <div class="warning__progress"></div>
                    </div>
        <?php
    }
}
if (isset($_COOKIE["email"])) {
    header("Location: index.php?page=profile&error=alreadyLoggedIn");
    exit();
}
require_once "utils/functions.php";
require_once "utils/dbaccess.php";
//? serverseitige Validierung
$email = $password = "";
$emailErr = $passwordErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $emailErr = "Email erforderlich";
    } else {
        $email = input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Das ist keine richtige Email-Adresse";
            $email = "";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Passwort erforderlich";
    } else {
        $password = input($_POST["password"]);
    }
}
//? Daten mit Datenbank vergleichen
if (empty($emailErr) && empty($passwordErr)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = input($_POST["email"]);
        $password = input($_POST["password"]);

        //?  Validate the email and password
        if (!empty($email) && !empty($password)) {
            //?  Check if the user exists in the database
            $userData = emailExists($conn, $email);
            if ($userData) {
                //?  Check if the user is active
                $sql = "SELECT * FROM users WHERE email = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: index.php?page=landing&error=stmtFailed");
                    exit();
                }
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                if ($row["active"] == 1) {
                    //?  Verify the password
                    if (password_verify($password, $userData["password"])) {
                        //?  Password is correct
                        setcookie("email", $email, time() + (86400 * 30), "/", null, false, true);
                        //? Datenbankabfrage
                        $sql = "SELECT * FROM users WHERE email = ?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: index.php?page=landing&error=stmtFailed");
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        if ($row["type"] == "admin") {
                            $_SESSION["admin"] = true;
                            header("Location: index.php?page=landing&error=noneAdminLogin");
                        } else {
                            header("Location: index.php?page=landing&error=noneLogin");
                        }
                    } else {
                        header("Location: index.php?page=login&error=wrongPassword"); ?>
                    <?php }
                } else {
                    //? User is not active
                    header("Location: index.php?page=login&error=notActive");
                }
            } else {
                //? User does not exist
                header("Location: index.php?page=login&error=wrongEmail");
            }
        }
    }
}
?>
<div class="container" style="margin-bottom: 100px;">
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 30rem;">
        <div style="text-align: center;">
            <h1>Login</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=login"); ?>">
                <?php if (!isset($_GET["register"])) { ?>
                    <p class="text-center">Noch nicht registriert?</p>
                    <a href="index.php?page=register" class="mb-3 a-glow">
                        <span></span>
                        Zur Registrierung
                    </a>
                <?php } ?>
                <div class="user-box">
                    <input type="text" name="email" value="<?php echo $email ?>" placeholder="<?php echo $emailErr ?>"
                        tabindex="1">
                    <label>E-Mail</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" value="<?php echo $password ?>"
                        placeholder="<?php echo $passwordErr ?>" tabindex="2">
                    <label>Passwort</label>
                </div>
                <input type="submit" value="Login" class="loginBoxSubmit">
            </form>
        </div>
    </div>
</div>