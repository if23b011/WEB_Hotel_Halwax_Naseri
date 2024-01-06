<?php
require_once 'utils/functions.php';
require_once 'utils/dbaccess.php';
if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) {
    header("Location: index.php?page=profile");
    exit();
}
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
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                if ($row['active'] == 1) {
                    //?  Verify the password
                    if (password_verify($password, $userData['password'])) {
                        //?  Password is correct
                        $_SESSION['login'] = true;
                        $_SESSION['email'] = $email;
                        //? Datenbankabfrage
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if ($row['type'] == 'admin') {
                            header("Location: index.php?page=landingNtf&error=noneAdminLogin");
                        } else {
                            header("Location: index.php?page=landingNtf&error=noneLogin");
                        }
                    } else {
                        header("Location: index.php?page=loginNtf&error=wrongPassword"); ?>
                    <?php }
                } else {
                    //? User is not active
                    header("Location: index.php?page=loginNtf&error=notActive");
                }
            } else {
                //? User does not exist
                header("Location: index.php?page=loginNtf&error=wrongEmail");
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