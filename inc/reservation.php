<?php
if (!isset($_COOKIE["email"])) {
    header("Location: index.php?page=landingNtf&error=notLoggedIn");
    exit();
}
require_once "utils/dbaccess.php";
require_once "utils/functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room = $_SESSION["zimmer"];
    $arrival = $departure = $arrivalDate = $departureDate = $breakfast = $parking = $pets = $comments = "";
    $status = "neu";
    $reservationDate = date("d.m.Y", time());
    $FK_userId = $_COOKIE["email"];
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

//? Funktionen für Reservierung
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
    $sql = "INSERT INTO reservations (room, arrivalDate, departureDate, breakfast, parking, pets, comments, reservationDate, totalCost, status, FK_userId) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssiiissdsi", $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId);
    mysqli_stmt_execute($stmt);

}
function roomIsBooked($conn, $room, $arrivalDate, $departureDate)
{
    $sql = "SELECT * FROM reservations WHERE room = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $room);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $arrival = date("d.m.Y", strtotime($row["arrivalDate"]));
        $departure = date("d.m.Y", strtotime($row["departureDate"]));
        if (strtotime($arrivalDate) >= strtotime($arrival) && strtotime($arrivalDate) <= strtotime($departure)) {
            return true;
        } else if (strtotime($departureDate) >= strtotime($arrival) && strtotime($departureDate) <= strtotime($departure)) {
            return true;
        }
    }
}

if (isset($departureDate) && isset($arrivalDate)) {
    $timestamp = time();
    $today = date("d.m.Y", $timestamp);
    if (strtotime($arrival) <= strtotime($today)) { ?>
        <p style="color: red;">Anreisedatum muss nach
            <?php $today ?> sein!
        </p>
    <?php } else if (strtotime($departure) <= strtotime($arrival)) { ?>
            <p style="color: red;">Anreisedatum muss vor Abreisedatum liegen!</p>
    <?php } else if (roomIsBooked($conn, $room, $arrivalDate, $departureDate)) { ?>
                <p style="color: red;">Dieses Zimmer ist bereits für diesen Zeitraum gebucht!</p>
    <?php } else {
        //? Daten in Datenbank speichern
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
        if ($comments == "") {
            $comments = "keine";
        }
        $sql = "SELECT userId FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landingNtf&error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $FK_userId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $FK_userId = $row["userId"];
        createReservation($conn, $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId);
        header("Location: index.php?page=reservationsNtf&error=noneReservation");
    }
}
?>
<div class="container" style="margin-bottom: 100px;">
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 42rem;">
        <div style="text-align: center;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=reservation"); ?>">
                <a class="mb-3">
                    <span></span>
                    <h1>Reservierung</h1>
                </a>
                <div class="user-box">
                    <input type="text" id="disabledTextInput" value="<?php echo $_SESSION["zimmer"] ?>" disabled>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 user-box">
                        <input type="date" name="arrivalDate" tabindex="1" required>
                        <label>Anreisedatum</label>
                    </div>
                    <div class="col-12 col-md-6 user-box">
                        <input type="date" name="departureDate" tabindex="1" required>
                        <label>Abreisedatum</label>
                    </div>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                        name="breakfast" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">
                        <p>Frühstück (Aufpreis von 5€ /
                            Nacht)</p>
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                        name="parking">
                    <label class="form-check-label" for="flexSwitchCheckDefault">
                        <p>Parkplatz (Aufpreis von 10€ /
                            Nacht)</p>
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                        name="pets">
                    <label class="form-check-label" for="flexSwitchCheckDefault">
                        <p>Mitnahme von Haustieren (Aufpreis von
                            15€)</p>
                    </label>
                </div>
                <div class="form-group">
                    <label for="comments">
                        <p>Bemerkungen</p>
                    </label>
                    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" value="Buchen" class="loginBoxSubmit">
                </div>
            </form>
        </div>
    </div>
</div>