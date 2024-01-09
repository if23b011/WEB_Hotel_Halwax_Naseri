<?php
if (!isset($_COOKIE["admin"])) {
    header("Location: index.php?page=landing&error=noAccess");
    exit();
}
require_once "utils/dbaccess.php";
require_once "utils/functions.php";
function calculateNewCost($room, $arrivalDate, $departureDate, $breakfast, $parking, $pets)
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
    if ($breakfast == 1) {
        $totalCost += $days * 5;
    }
    if ($parking == 1) {
        $totalCost += $days * 10;
    }
    if ($pets == 1) {
        $totalCost += 15;
    }
    return $totalCost;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["reservationId"]) && isset($_POST["room"]) && isset($_POST["arrivalDate"]) && isset($_POST["departureDate"]) && isset($_POST["breakfast"]) && isset($_POST["parking"]) && isset($_POST["pets"]) && isset($_POST["comments"]) && isset($_POST["status"])) {
        $reservationId = $_POST["reservationId"];
        $room = $_POST["room"];
        $arrival = $_POST["arrivalDate"];
        $departure = $_POST["departureDate"];
        if ($_POST["breakfast"] == "inkludiert") {
            $breakfast = 1;
        } else {
            $breakfast = 0;
        }
        if ($_POST["parking"] == "inkludiert") {
            $parking = 1;
        } else {
            $parking = 0;
        }
        if ($_POST["pets"] == "inkludiert") {
            $pets = 1;
        } else {
            $pets = 0;
        }
        $status = $_POST["status"];
        $totalCost = calculateNewCost($room, $arrival, $departure, $breakfast, $parking, $pets);
        $sql = "UPDATE reservations SET room = ?, arrivalDate = ?, departureDate = ?, breakfast = ?, parking = ?, pets = ?, totalCost = ?, status=? WHERE reservationId=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landing&error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "sssiiiisi", $room, $arrival, $departure, $breakfast, $parking, $pets, $totalCost, $status, $reservationId);
        mysqli_stmt_execute($stmt);
    }
} ?>
<?php
$filter = isset($_POST["filter"]) ? $_POST["filter"] : "alle";
if ($filter == "alle") {
    $sql = "SELECT * FROM reservations";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landing&error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $sql = "SELECT * FROM reservations WHERE status = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landing&error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $filter);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
if ($result->num_rows > 0) { ?>
    <div style="margin-bottom: 100px;">
        <div class="login-box d-flex justify-content-center align-items-center" style="width: 90%; max-width: 42rem;">
            <div style="text-align: center;">
                <h1>Reservierungen</h1>
                <p class="text-center">Bearbeiten Sie jeweils nur eine Reservierung</p>
                <form method="post" action="">
                    <select class="form-select" name="filter" id="filter">
                        <option value="alle" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "alle" ? "selected" : ""; ?>>alle</option>
                        <option value="neu" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "neu" ? "selected" : ""; ?>>neu</option>
                        <option value="bestätigt" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "bestätigt" ? "selected" : ""; ?>>bestätigt</option>
                        <option value="storniert" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "storniert" ? "selected" : ""; ?>>storniert</option>
                    </select>
                    <div class="d-flex justify-content-center">
                        <input type="submit" value="Filtern" style="white-space: normal" class="loginBoxSubmit">
                    </div>
                </form>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT * FROM users WHERE userId=" . $row["FK_userId"];
                    $result2 = $conn->query($sql);
                    $row2 = $result2->fetch_assoc();
                    if ($row2["gender"] == "M") {
                        $genderWritten = "Herr ";
                    } else {
                        $genderWritten = "Frau ";
                    }
                    $person = $genderWritten . " " . $row2["firstname"] . " " . $row2["lastname"];
                    $reservationId = $row["reservationId"];
                    $room = $row["room"];
                    $arrival = $row["arrivalDate"];
                    $arrivalDate = date("d.m.Y", strtotime($arrival));
                    $departure = $row["departureDate"];
                    $departureDate = date("d.m.Y", strtotime($departure));
                    if ($row["breakfast"] == 1) {
                        $breakfast = "inkludiert";
                    } else {
                        $breakfast = "nicht inkludiert";
                    }
                    if ($row["parking"] == 1) {
                        $parking = "inkludiert";
                    } else {
                        $parking = "nicht inkludiert";
                    }
                    if ($row["pets"] == 1) {
                        $pets = "inkludiert";
                    } else {
                        $pets = "nicht inkludiert";
                    }
                    $comments = $row["comments"];
                    $reservationDate = $row["reservationDate"];
                    $totalCost = $row["totalCost"];
                    $status = $row["status"]; ?>
                    <form method="post" id="form<?php echo $reservationId; ?>"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=reservationManagement"); ?>">
                        <a>
                            <span></span>
                            <h2>
                                <?php
                                echo "$person";
                                ?>
                            </h2>
                        </a>
                        <input type="text" name="reservationId" value="<?php echo $reservationId ?>" hidden>
                        <select class="form-select mb-5" name="room">
                            <option value="Einzelzimmer mit Einzelbett" <?php echo $room == "Einzelzimmer mit Einzelbett" ? "selected" : ""; ?>>Einzelzimmer mit Einzelbett
                            </option>
                            <option value="Einzelzimmer mit Doppelbett" <?php echo $room == "Einzelzimmer mit Doppelbett" ? "selected" : ""; ?>>Einzelzimmer mit Doppelbett</option>
                            <option value="Luxus Zimmer mit Jacuzzi" <?php echo $room == "Luxus Zimmer mit Jacuzzi" ? "selected" : ""; ?>>Luxus Zimmer mit Jacuzzi</option>
                            <option value="Luxus Suite mit privatem Butler" <?php echo $room == "Luxus Suite mit privatem Butler" ? "selected" : ""; ?>>Luxus Suite mit privatem Butler</option>
                        </select>
                        <div class="user-box">
                            <input type="date" name="arrivalDate" value="<?php echo $arrival ?>">
                            <label>Anreise</label>
                        </div>
                        <div class="user-box">
                            <input type="date" name="departureDate" value="<?php echo $departure ?>">
                            <label>Abreise</label>
                        </div>
                        <div class="user-box mb-2">
                            <input type="hidden">
                            <label>Frühstück</label>
                        </div>
                        <select class="form-select mb-4" name="breakfast">
                            <option value="inkludiert" <?php echo $breakfast == "inkludiert" ? "selected" : ""; ?>>inkludiert
                            </option>
                            <option value="nicht inkludiert" <?php echo $breakfast == "nicht inkludiert" ? "selected" : ""; ?>>
                                nicht inkludiert</option>
                        </select>
                        <div class="user-box mb-2">
                            <input type="hidden">
                            <label>Parkplatz</label>
                        </div>
                        <select class="form-select mb-4" name="parking">
                            <option value="inkludiert" <?php echo $parking == "inkludiert" ? "selected" : ""; ?>>inkludiert
                            </option>
                            <option value="nicht inkludiert" <?php echo $parking == "nicht inkludiert" ? "selected" : ""; ?>>
                                nicht inkludiert</option>
                        </select>
                        <div class="user-box mb-2">
                            <input type="hidden">
                            <label>Haustiere</label>
                        </div>
                        <select class="form-select mb-4" name="pets">
                            <option value="inkludiert" <?php echo $pets == "inkludiert" ? "selected" : ""; ?>>inkludiert
                            </option>
                            <option value="nicht inkludiert" <?php echo $pets == "nicht inkludiert" ? "selected" : ""; ?>>
                                nicht inkludiert</option>
                        </select>
                        <div class="user-box">
                            <input type="text" name="comments" value=" <?php echo $comments ?>" readonly>
                            <label>Kommentare</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="reservationDate" readonly
                                value="<?php echo date("d.m.Y", strtotime($reservationDate)) ?>">
                            <label>Reservierungsdatum</label>
                        </div>
                        <?php //TODO: Total Cost neu berechnen 
                                ?>
                        <div class="user-box">
                            <input type="text" name="totalCost" readonly value="<?php echo $totalCost . "€" ?>">
                            <label>Gesamtkosten</label>
                        </div>
                        <div class="user-box">
                            <input type="hidden">
                            <label>Status</label>
                        </div>
                        <select class="form-select mb-4" name="status">
                            <option value="neu" <?php echo $status == "neu" ? "selected" : ""; ?>>neu
                            </option>
                            <option value="bestätigt" <?php echo $status == "bestätigt" ? "selected" : ""; ?>>bestätigt
                            </option>
                            <option value="storniert" <?php echo $status == "storniert" ? "selected" : ""; ?>>storniert
                            </option>
                        </select>
                        <div class="d-flex justify-content-center mb-4">
                            <input type="submit" value="Änderungen übernehmen" style="white-space: normal"
                                class="loginBoxSubmit">
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <?php
} else {
    ?>
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="login-box">
                    <h1>Reservierungen</h1>
                    <form method="post" action="">
                        <select class="form-select" name="filter" id="filter">
                            <option value="alle" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "alle" ? "selected" : ""; ?>>alle</option>
                            <option value="neu" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "neu" ? "selected" : ""; ?>>neu</option>
                            <option value="bestätigt" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "bestätigt" ? "selected" : ""; ?>>bestätigt</option>
                            <option value="storniert" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "storniert" ? "selected" : ""; ?>>storniert</option>
                        </select>
                        <div class="d-flex justify-content-center">
                            <input type="submit" value="Filtern" style="white-space: normal" class="loginBoxSubmit">
                        </div>
                    </form>
                    <h2 style="color: red">Keine Reservierungen mit diesem Filter gefunden.</h2>
                </div>
            </div>
        </div>
        <?php
}
?>
</div>