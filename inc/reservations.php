<div class="container" style="margin-bottom: 100px;">
    <h1>Meine Reservierungen</h1>
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
                exit();
            } else {
                $number = 1;
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
                    }
                    if (isset($_GET["reservation"]) && $_GET["reservation"] == "success") {
                        echo '<div class="alert alert-success" role="alert">Deine Reise vom ' . date("d.m.Y", strtotime($arrivalDate)) . ' bis ' . date("d.m.Y", strtotime($departureDate)) .
                            ' wurde mit folgenden Bemerkungen gebucht: Frühstück ' . $breakfast . ', Parkplatz ' . $parking .
                            ', Haustiere ' . $pets . '</div>';
                        //TODO: Weiterleitung fixen
                        header("Refresh: 3; Location: index.php?page=reservations");
                    }
                    echo '<p>Reservierungsnummer: ' . $number . '<br></p>';
                    echo '<p>Zimmer: ' . $room . '<br></p>';
                    echo '<p>Anreise: ' . date("d.m.Y", strtotime($arrivalDate)) . '<br></p>';
                    echo '<p>Abreise: ' . date("d.m.Y", strtotime($departureDate)) . '<br></p>';
                    echo '<p>Frühstück: ' . $breakfast . '<br></p>';
                    echo '<p>Parkplatz: ' . $parking . '<br></p>';
                    echo '<p>Haustiere: ' . $pets . '<br></p>';
                    echo '<p>Kommentare: ' . $comments . '<br></p>';
                    echo '<p>Reservierungsdatum: ' . date("d.m.Y", strtotime($reservationDate)) . '<br></p>';
                    echo '<p>Gesamtkosten: ' . $totalCost . '€<br></p>';
                    echo '<p>Status: ' . $status . '<br></p>'; ?>
                    <p>------------------------<br></p>
                    <?php $number++;
                }
            }
            mysqli_stmt_close($stmt);
            ?>
        </div>
    </div>
</div>