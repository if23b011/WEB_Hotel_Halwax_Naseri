<div class="container" style="margin-bottom: 100px;">
    <div class="d-grid col-12 mx-auto">
        <div class="mb-3 container">
            <?php
            require_once 'utils/dbaccess.php';
            $sql = "SELECT userId FROM users WHERE email = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                <p>SQL statement failed</p>
                <?php return;
            }
            mysqli_stmt_bind_param($stmt, "s", $_SESSION["email"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $FK_userId = $row['userId'];
            mysqli_stmt_close($stmt);

            $sql = "SELECT * FROM reservations WHERE FK_userId = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                <p>SQL statement failed</p>
                <?php return;
            }
            mysqli_stmt_bind_param($stmt, "i", $FK_userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result->num_rows == 0) {
                header("Location: index.php?page=buchung&reservation=none");
            } else {
                $number = 1; ?>
                <div class="login-box d-flex justify-content-center align-items-center"
                    style="width: 100%; max-width: 42rem;">
                    <div style="text-align: center;">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=login"); ?>">
                            <a class="mb-3">
                                <h1>Reservierungen</h1>
                            </a>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $room = $row['room'];
                                $arrivalDate = $row['arrivalDate'];
                                $departureDate = $row['departureDate'];
                                $breakfast = $row['breakfast'];
                                $parking = $row['parking'];
                                $pets = $row['pets'];
                                $comments = $row['comments'];
                                $reservationDate = $row['reservationDate'];
                                $totalCost = $row['totalCost'];
                                $status = $row['status'];
                                if ($breakfast == 1) {
                                    $breakfast = "inkludiert";
                                } else {
                                    $breakfast = "nicht inkludiert";
                                }
                                if ($parking == 1) {
                                    $parking = "inkludiert";
                                } else {
                                    $parking = "nicht inkludiert";
                                }
                                if ($pets == 1) {
                                    $pets = "inkludiert";
                                } else {
                                    $pets = "nicht inkludiert";
                                }
                                if (empty($comments)) {
                                    $comments = "keine";
                                } ?>
                                <p></p>
                                <a>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <h2>
                                        Reservierung<?php echo " " . $number ?>
                                    </h2>
                                </a>
                                <div class="user-box">
                                    <input type="text" name="room" disabled value="<?php echo $room ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="arrivalDate" disabled
                                        value="Anreise: <?php echo date("d.m.Y", strtotime($arrivalDate)) ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="departureDate" disabled
                                        value="Abreise: <?php echo date("d.m.Y", strtotime($departureDate)) ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="breakfast" disabled value="Frühstück: <?php echo $breakfast ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="parking" disabled value="Parkplatz: <?php echo $parking ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="pets" disabled value="Haustiere: <?php echo $pets ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="comments" disabled value="Kommentare: <?php echo $comments ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="reservationDate" disabled
                                        value="Reservierungsdatum: <?php echo date("d.m.Y", strtotime($reservationDate)) ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="totalCost" disabled value="Gesamtkosten: <?php echo $totalCost ?>">
                                </div>
                                <div class="user-box">
                                    <input type="text" name="status" disabled value="Status: <?php echo $status ?>">
                                </div>
                                <?php $number++;
                            }
            }
            mysqli_stmt_close($stmt);
            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>