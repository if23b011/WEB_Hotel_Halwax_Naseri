<div style="margin-bottom: 100px;">
    <div class="d-grid col-12 mx-auto">
        <div class="mb-3 container">
            <?php
            require_once 'utils/dbaccess.php';
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                ?>
                <div class="login-box d-flex justify-content-center align-items-center"
                    style="width: 100%; max-width: 42rem;">
                    <div style="text-align: center;">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <a class="mb-3">
                                <h1>User</h1>
                            </a>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <p></p>
                                <a>
                                    <span></span>
                                    <h2>
                                        <?php
                                        if ($row["gender"] == "M") {
                                            echo "Herr ";
                                        } else {
                                            echo "Frau ";
                                        }
                                        echo $row["firstname"] . " " . $row["lastname"];
                                        ?>
                                    </h2>
                                </a>
                                <div class="user-box">
                                    <input type="text" name="firstname" value="<?php echo $row["firstname"] ?>" tabindex="1">
                                    <label>Vorname</label>
                                </div>
                                <div class="user-box">
                                    <input type="text" name="lastname" value="<?php echo $row["lastname"] ?>" tabindex="2">
                                    <label>Nachname</label>
                                </div>
                                <div class="user-box">
                                    <input type="text" name="email" value="<?php echo $row["email"] ?>" tabindex="3">
                                    <label>E-Mail</label>
                                </div>
                                <div class="user-box">
                                    <input type="date" name="birthdate" value="<?php echo $row["birthdate"] ?>" tabindex="4">
                                    <label>Geburtstag</label>
                                </div>
                                <div class="user-box">
                                    <input type="text" name="type" value="<?php echo $row["type"] ?>" tabindex="4">
                                    <label>Type</label>
                                </div>
                                <?php
                            }
            } ?>
                    </form>
                </div>
            </div>