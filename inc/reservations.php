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
                header("Location: index.php?page=buchung&error=noReservations");
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
                                        Reservierung
                                        <?php echo " " . $number ?>
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
                                    <?php if ($breakfast == 1) {
                                        $breakfast = "inkludiert"; ?>
                                        <input type="text" name="breakfast" disabled style="color: green;"
                                            value="Frühstück: <?php echo $breakfast ?>">
                                    <?php } else if ($breakfast == 0) {
                                        $breakfast = "nicht inkludiert"; ?>
                                            <input type="text" name="breakfast" disabled style="color: red;"
                                                value="Frühstück: <?php echo $breakfast ?>">
                                    <?php } ?>
                                </div>
                                <div class="user-box">
                                    <?php if ($parking == 1) {
                                        $parking = "inkludiert"; ?>
                                        <input type="text" name="parking" disabled style="color: green;"
                                            value="Parkplatz: <?php echo $parking ?>">
                                    <?php } else if ($parking == 0) {
                                        $parking = "nicht inkludiert"; ?>
                                            <input type="text" name="parking" disabled style="color: red;"
                                                value="Parkplatz: <?php echo $parking ?>">
                                    <?php } ?>
                                </div>
                                <div class="user-box">
                                    <?php if ($pets == 1) {
                                        $pets = "inkludiert"; ?>
                                        <input type="text" name="pets" disabled style="color: green;"
                                            value="Haustiere: <?php echo $pets ?>">
                                    <?php } else if ($pets == 0) {
                                        $pets = "nicht inkludiert"; ?>
                                            <input type="text" name="pets" disabled style="color: red;"
                                                value="Haustiere: <?php echo $pets ?>">
                                    <?php } ?>
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