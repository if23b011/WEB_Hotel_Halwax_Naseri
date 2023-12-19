<div style="margin-bottom: 100px;">
    <h1>User</h1>
    <div class="d-grid col-12 mx-auto">
        <div class="mb-3 container">
            <?php
            require_once 'utils/dbaccess.php';
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                ?>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="d-grid col-md-6 mx-auto">
                        <p>
                            <?php
                            if ($row["gender"] == "M") {
                                echo "Herr ";
                            } else {
                                echo "Frau ";
                            }
                            echo $row["firstname"] . " " . $row["lastname"];
                            ?>
                        </p>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="text" class="form-control mb-2" name="firstname"
                                value="<?php echo $row["firstname"] ?>" tabindex="1">
                            <input type="text" class="form-control mb-2" name="lastname" value="<?php echo $row["lastname"] ?>"
                                tabindex="2">
                            <input type="text" class="form-control mb-2" name="email" value="<?php echo $row["email"] ?>"
                                tabindex="3">
                            <input type="date" class="form-control mb-2" name="birthdate"
                                value="<?php echo $row["birthdate"] ?>" tabindex="4">
                            <input type="text" class="form-control mb-5" name="type" value="<?php echo $row["type"] ?>"
                                tabindex="4">
                        </form>
                    </div>
                    <?php
                }
            } else { ?>
                <h3>Keine News vorhanden!</h3>
            </div>
            <?php header("Location: index.php?page=landing&error=noNews");
            }
            ?>