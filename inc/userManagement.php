<div style="margin-bottom: 100px;">
    <?php
    $userId = $gender = $firstname = $lastname = $email = $date = $type = $active = "";
    require_once 'utils/dbaccess.php';
    require_once 'utils/functions.php';
    $sql = "SELECT * FROM users WHERE type = 'user'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div class="login-box d-flex justify-content-center align-items-center" style="width: 100%; max-width: 42rem;">
            <div style="text-align: center;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=userManagement"); ?>">
                    <a class="mb-3">
                        <h1>User</h1>
                    </a>
                    <?php
                    //FIXME: ALLE HEIßEN ARMIN NASERI
                    while ($row = $result->fetch_assoc()) {
                        $userId = input($row["userId"]);
                        $gender = input($row["gender"]);
                        $firstname = input($row["firstname"]);
                        $lastname = input($row["lastname"]);
                        $email = input($row["email"]);
                        $date = input($row["birthdate"]);
                        $birthDate = date("Y-m-d", strtotime($date));
                        $type = input($row["type"]);
                        $active = input($row["active"]);
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST["gender"])) {
                                $gender = input($_POST["gender"]);
                            }
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
                            if (isset($_POST["type"])) {
                                $type = input($_POST["type"]);
                            }
                            if (isset($_POST["active"])) {
                                $active = input($_POST["active"]);
                            }
                            $sql = "UPDATE users SET gender = ?, firstname = ? , lastname = ? , birthdate = ? , type = ? , active = ? WHERE userId = ?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                                <p>SQL-Fehler</p>
                                <?php return;
                            }
                            mysqli_stmt_bind_param($stmt, "sssssss", $gender, $firstname, $lastname, $birthDate, $type, $active, $userId);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
                        }
                        ?>
                        <p></p>
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
                        <div class="user-box">
                            <input type="text" name="userId" value="<?php echo $userId ?>" disabled>
                            <label>UserID</label>
                        </div>
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
                            <input type="text" name="email" value="<?php echo $email ?>">
                            <label>E-Mail</label>
                        </div>
                        <div class="user-box">
                            <input type="date" name="birthdate" value="<?php echo $date ?>">
                            <label>Geburtstag</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="type" value="<?php echo $type ?>">
                            <label>Type</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="type" value="<?php echo $active ?>">
                            <label>Account aktiv (1=aktiv, 0 = inkativ)</label>
                        </div>
                        <input type="submit" value="Änderungen übernehmen" class="loginBoxSubmit">
                        <?php
                    }
    } ?>
            </form>
        </div>
    </div>
</div>