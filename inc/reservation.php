<div class="container" style="margin-bottom: 100px;">
    <h1>Reservierung</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $room = $_SESSION['zimmer'];
        $arrival = $departure = $arrivalDate = $departureDate = $breakfast = $parking = $pets = $comments = "";
        $status = "neu";
        $reservationDate = date("d.m.Y", time());
        $FK_userId = $_COOKIE['email'];
        if (isset($_POST["arrivalDate"])) {
            $arrival = input($_POST["arrivalDate"]);
            $arrivalDate = date("d.m.Y", strtotime($arrival));
        }
        if (isset($_POST["departureDate"])) {
            $departure = input($_POST["departureDate"]);
            $departureDate = date("d.m.Y", strtotime($departure));
        }
        if (isset($_POST["breakfast"])) {
            $breakfast = "inkludiert";
        } else {
            $breakfast = "nicht inkludiert";
        }
        if (isset($_POST["parking"])) {
            $parking = "inkludiert";
        } else {
            $parking = "nicht inkludiert";
        }
        if (isset($_POST["pets"])) {
            $pets = "inkludiert";
        } else {
            $pets = "nicht inkludiert";
        }
        if (isset($_POST["comments"])) {
            $comments = input($_POST["comments"]);
        }
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=reservation"); ?>">
        <div class="container">
            <div class="d-grid gap-3 col-md-6 mx-auto">
                <input type="text" id="disabledTextInput" class="form-control" value="<?php echo $_SESSION['zimmer'] ?>"
                    disabled>
                <div class="row row-cols-1 row-cols-md-2 align-items-start">
                    <div class="col">
                        <label for="date" class="form-label">
                            <p>Anreisedatum</p>
                        </label>
                        <input type="date" class="form-control" name="arrivalDate" value="<?php echo $arrivalDate; ?>">
                    </div>
                    <div class="col">
                        <label for="date" class="form-label">
                            <p>Abreisedatum</p>
                        </label>
                        <input type="date" class="form-control" name="departureDate"
                            value="<?php echo $departureDate; ?>">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="breakfast">
                    <label class="form-check-label" for="flexCheckDefault">
                        <p>Frühstück (Aufpreis von 5€ / Nacht)</p>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="parking">
                    <label class="form-check-label" for="flexCheckDefault">
                        <p>Parkplatz (Aufpreis von 10€ / Nacht)</p>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="pets">
                    <label class="form-check-label" for="flexCheckDefault">
                        <p>Mitnahme von Haustieren (Aufpreis von 15€)</p>
                    </label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">
                        <p>Bemerkungen</p>
                    </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comments"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <input class="btn btn-primary" type="submit" value="Buchen">
                </div>
                <?php
                if (isset($departureDate) && isset($arrivalDate)) {
                    $timestamp = time();
                    $today = date("d.m.Y", $timestamp);
                    if (strtotime($arrival) <= strtotime($today)) {
                        echo '<p style="color: red;">Anreisedatum muss nach ' . $today . ' sein!</p>';
                    } else if (strtotime($departure) <= strtotime($arrival)) { ?>
                            <p style="color: red;">Anreisedatum muss vor Abreisedatum liegen!</p>
                    <?php } else {
                        //? Daten in Datenbank speichern
                        require_once 'utils/dbaccess.php';
                        $totalCost = calculateCost($room, $arrivalDate, $departureDate, $breakfast, $parking, $pets);
                        $arrivalDate = date("Y-m-d", strtotime($arrivalDate));
                        $departureDate = date("Y-m-d", strtotime($departureDate));
                        $reservationDate = date("Y-m-d", strtotime($reservationDate));
                        if ($breakfast == "inkludiert") {
                            $breakfast = 1;
                        } else {
                            $breakfast = 0;
                        }
                        if ($parking == "inkludiert") {
                            $parking = 1;
                        } else {
                            $parking = 0;
                        }
                        if ($pets == "inkludiert") {
                            $pets = 1;
                        } else {
                            $pets = 0;
                        }
                        $sql = "SELECT userId FROM users WHERE email = ?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                                <p>SQL statement failed</p>
                            <?php return;
                        }
                        mysqli_stmt_bind_param($stmt, "s", $FK_userId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $row = mysqli_fetch_assoc($result);
                        $FK_userId = $row['userId'];
                        mysqli_stmt_close($stmt);
                        createReservation($conn, $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId);
                        //TODO: Weiterleitung fixen
                        header("Location: index.php?page=reservations&reservation=success");
                    }
                }
                function calculateCost($room, $arrivalDate, $departureDate, $breakfast, $parking, $pets)
                {
                    $totalCost = 0;
                    $days = (strtotime($departureDate) - strtotime($arrivalDate)) / (60 * 60 * 24);
                    if ($room == "Einzelzimmer mit Einzelbett") {
                        $totalCost = $days * 30;
                    } else if ($room == "Einzelzimmer mit Doppelbett") {
                        $totalCost = $days * 75;
                    } else if ($room == "Luxus Zimmer mit Jacuzzi") {
                        $totalCost = $days * 200;
                    } else if ($room == "Luxus Suite mit privatem Butler") {
                        $totalCost = $days * 500;
                    }
                    if ($breakfast == "inkludiert") {
                        $totalCost += $days * 5;
                    }
                    if ($parking == "inkludiert") {
                        $totalCost += $days * 10;
                    }
                    if ($pets == "inkludiert") {
                        $totalCost += 15;
                    }
                    return $totalCost;
                }
                function createReservation($conn, $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId)
                {
                    require_once 'utils/dbaccess.php';
                    $sql = "INSERT INTO reservations (room, arrivalDate, departureDate, breakfast, parking, pets, comments, reservationDate, totalCost, status, FK_userId) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                        <p>SQL statement failed</p>
                        <?php return;
                    }

                    mysqli_stmt_bind_param($stmt, "sssiiissdsi", $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                function input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                ?>
            </div>
    </form>
</div>