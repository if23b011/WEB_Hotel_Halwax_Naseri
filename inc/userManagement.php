<div style="margin-bottom: 100px;">
    <?php
    if (!isset($_COOKIE["admin"])) {
        header("Location: index.php?page=landingNtf&error=noAccess");
        exit();
    }
    require_once "utils/dbaccess.php";
    require_once "utils/functions.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_POST["userId"];
        if ($_POST["gender"] == "männlich") {
            $gender = "M";
        } else {
            $gender = "W";
        }
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $birthdate = $_POST["birthdate"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $type = $_POST["type"];
        if ($_POST["active"] == "aktiv") {
            $active = 1;
        } else {
            $active = 0;
        }
        if ($password == "") {
            $sql = "UPDATE users SET gender = ?, firstname = ?, lastname = ?, birthdate = ?, email = ?, type=?, active=? WHERE userId=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?page=landingNtf&error=stmtFailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "ssssssii", $gender, $firstname, $lastname, $birthdate, $email, $type, $active, $userId);
            mysqli_stmt_execute($stmt);
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET gender = ?, firstname = ?, lastname = ?, birthdate = ?, email = ?, password = ?, type=?, active=? WHERE userId=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: index.php?page=landingNtf&error=stmtFailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "sssssssii", $gender, $firstname, $lastname, $birthdate, $email, $hashedPassword, $type, $active, $userId);
            mysqli_stmt_execute($stmt);
        }
    }
    $sql = "SELECT * FROM users ORDER BY type DESC;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        ?>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="login-box">
                    <h1>User</h1>
                    <p class="text-center">Bearbeiten Sie jeweils nur einen Benutzer</p>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <?php
                        $userId = $row["userId"];
                        if ($row["gender"] == "M") {
                            $gender = "Herr ";
                        } else {
                            $gender = "Frau ";
                        }
                        $firstname = $row["firstname"];
                        $lastname = $row["lastname"];
                        $date = $row["birthdate"];
                        $email = $row["email"];
                        $type = $row["type"];
                        if ($row["active"] == 1) {
                            $active = "aktiv";
                        } else {
                            $active = "nicht aktiv";
                        }
                        ?>
                        <form method="post" id="form<?php echo $userId; ?>"
                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=userManagement"); ?>">
                            <a>
                                <span></span>
                                <h2>
                                    <?php
                                    if ($row["gender"] == "M") {
                                        $genderWritten = "Herr ";
                                    } else {
                                        $genderWritten = "Frau ";
                                    }
                                    echo $genderWritten . " " . $row["firstname"] . " " . $row["lastname"];
                                    ?>
                                </h2>
                            </a>
                            <input type="text" name="userId" value="<?php echo $userId ?>" hidden>
                            <div class="user-box mb-2">
                                <input type="hidden">
                                <label>Geschlecht</label>
                            </div>
                            <select class="form-select mb-4" name="gender">
                                <option value="männlich" <?php echo $gender == "männlich" ? "selected" : ""; ?>>männlich
                                </option>
                                <option value="weiblich" <?php echo $gender == "weiblich" ? "selected" : ""; ?>>weiblich
                                </option>
                            </select>
                            <div class="user-box">
                                <input type="text" name="firstname" value="<?php echo $firstname ?>">
                                <label>Vorname</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="lastname" value="<?php echo $lastname ?>">
                                <label>Nachname</label>
                            </div>
                            <div class="user-box">
                                <input type="date" name="birthdate" value="<?php echo $date ?>">
                                <label>Geburtstag</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="email" value="<?php echo $email ?>">
                                <label>E-Mail</label>
                            </div>
                            <div class="user-box">
                                <input type="password" name="password" value="">
                                <label>Passwort bei Bedarf ändern</label>
                            </div>
                            <div class="user-box mb-2">
                                <input type="hidden">
                                <label>Type</label>
                            </div>
                            <select class="form-select mb-4" name="type">
                                <option value="user" <?php echo $type == "user" ? "selected" : ""; ?>>user
                                </option>
                                <option value="admin" <?php echo $type == "admin" ? "selected" : ""; ?>>admin
                                </option>
                            </select>
                            <div class="user-box mb-2">
                                <input type="hidden">
                                <label>Account aktiv</label>
                            </div>
                            <select class="form-select mb-4" name="active">
                                <option value="aktiv" <?php echo $active == "aktiv" ? "selected" : ""; ?>>aktiv
                                </option>
                                <option value="nicht aktiv" <?php echo $active == "nicht aktiv" ? "selected" : ""; ?>>nicht aktiv
                                </option>
                            </select>
                            <div class="d-flex justify-content-center mb-4">
                                <input type="submit" value="Änderungen übernehmen" style="white-space: normal"
                                    class="loginBoxSubmit">
                            </div>
                        </form>
                    <?php }
    } ?>
            </div>
        </div>
    </div>
</div>