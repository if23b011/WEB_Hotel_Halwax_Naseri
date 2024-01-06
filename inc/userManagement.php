<div style="margin-bottom: 100px;">
    <?php
    require_once 'utils/dbaccess.php';
    require_once 'utils/functions.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userId = $_POST['userId'];
        $gender = $_POST['gender'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthdate = $_POST['birthdate'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $type = $_POST['type'];
        $active = $_POST['active'];

        $sql = "UPDATE users SET gender=?, firstname=?, lastname=?, birthdate=?, email=?, password = ?, type=?, active=? WHERE userId=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landingNtf&error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssssssii", $gender, $firstname, $lastname, $birthdate, $email, $password, $type, $active, $userId);
        mysqli_stmt_execute($stmt);
        
    }
    $sql = "SELECT * FROM users WHERE type = 'user'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result->num_rows > 0) {
        ?>
        <div class="login-box d-flex justify-content-center align-items-center" style="width: 100%; max-width: 42rem;">
            <div style="text-align: center;">
                <h1>User</h1>
                <p>Bearbeiten Sie jeweils nur einen Benutzer</p>
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <?php
                    $userId = $row["userId"];
                    $gender = $row["gender"];
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $date = $row["birthdate"];
                    $email = $row["email"];
                    $password = "";
                    $type = $row["type"];
                    $active = $row["active"]; ?>
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
                        <div class="user-box">
                            <input type="text" name="gender" value="<?php echo $gender ?>">
                            <label>Geschlecht (M=männlich, W=weiblich)</label>
                        </div>
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
                            <input type="password" name="password" value="<?php echo $password ?>">
                            <label>Passwort bei Bedarf ändern</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="type" value="<?php echo $type ?>">
                            <label>Type</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="active" value="<?php echo $active ?>">
                            <label>Account aktiv (1=aktiv, 0 = inaktiv)</label>
                        </div>
                        <input type="submit" value="Änderungen übernehmen" class="loginBoxSubmit">
                    </form>
                <?php }
    } ?>
        </div>
    </div>
</div>