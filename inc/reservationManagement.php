<?php
if (!isset($_COOKIE["admin"])) {
    header("Location: index.php?page=landingNtf&error=noAccess");
    exit();
}
require_once "utils/dbaccess.php";
require_once "utils/functions.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["reservationId"]) && isset($_POST["room"]) && isset($_POST["arrivalDate"]) && isset($_POST["departureDate"]) && isset($_POST["breakfast"]) && isset($_POST["parking"]) && isset($_POST["pets"]) && isset($_POST["comments"]) && isset($_POST["status"])) {
        $reservationId = $_POST["reservationId"];
        $room = $_POST["room"];
        $arrival = $_POST["arrivalDate"];
        $departure = $_POST["departureDate"];
        $breakfast = $_POST["breakfast"];
        $parking = $_POST["parking"];
        $pets = $_POST["pets"];
        $comments = $_POST["comments"];
        $status = $_POST["status"];
        $sql = "UPDATE reservations SET room=?, arrivalDate=?, departureDate=?, breakfast=?, parking=?, pets=?, comments=?, status=? WHERE reservationId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiiissi", $room, $arrival, $departure, $breakfast, $parking, $pets, $comments, $status, $reservationId);
        $stmt->execute();
        $stmt->close();
    }
} ?>
<?php
$filter = isset($_POST["filter"]) ? $_POST["filter"] : "alle";
if ($filter == "alle") {
    $sql = "SELECT * FROM reservations";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $sql = "SELECT * FROM reservations WHERE status = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landingNtf&error=stmtFailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $filter);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}
if ($result->num_rows > 0) {
    ?>
    <div style="margin-bottom: 100px;">
        <div class="login-box d-flex justify-content-center align-items-center" style="width: 100%; max-width: 42rem;">
            <div style="text-align: center;">
                <h1>Reservierungen</h1>
                <p>Bearbeiten Sie jeweils nur eine Reservierung</p>
                <form method="post" action="">
                    <select class="form-select" name="filter" id="filter">
                        <option value="alle" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "alle" ? "selected" : ""; ?>>alle</option>
                        <option value="neu" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "neu" ? "selected" : ""; ?>>neu</option>
                        <option value="bestätigt" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "bestätigt" ? "selected" : ""; ?>>bestätigt</option>
                        <option value="storniert" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "storniert" ? "selected" : ""; ?>>storniert</option>
                    </select>
                    <input type="submit" value="Filtern" class="loginBoxSubmit">
                </form>
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <?php
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
                    $breakfast = $row["breakfast"];
                    $parking = $row["parking"];
                    $pets = $row["pets"];
                    $comments = $row["comments"];
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
                        <div class="user-box">
                            <input type="text" name="breakfast" value="<?php echo $breakfast ?>">
                            <label>Frühstück (1=inkludiert, 0 = nicht inkludiert)</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="parking" value="<?php echo $parking ?>">
                            <label>Parkplatz (1=inkludiert, 0 = nicht inkludiert)</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="pets" value="<?php echo $pets ?>">
                            <label>Haustiere (1=inkludiert, 0 = nicht inkludiert)</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="comments" value="<?php echo $comments ?>">
                            <label>Comments</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="status" value="<?php echo $status ?>">
                            <label>Status (neu/bestätigt/storniert)</label>
                        </div>
                        <input type="submit" value="Änderungen übernehmen" class="loginBoxSubmit">
                    </form>
                <?php }
} else { ?>
                <div class="login-box d-flex justify-content-center align-items-center"
                    style="width: 100%; max-width: 42rem;">
                    <div style="text-align: center;">
                        <h1>Reservierungen</h1>
                        <form method="post" action="">
                            <select class="form-select" name="filter" id="filter">
                                <option value="alle" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "alle" ? "selected" : ""; ?>>alle</option>
                                <option value="neu" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "neu" ? "selected" : ""; ?>>neu</option>
                                <option value="bestätigt" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "bestätigt" ? "selected" : ""; ?>>bestätigt</option>
                                <option value="storniert" <?php echo isset($_POST["filter"]) && $_POST["filter"] == "storniert" ? "selected" : ""; ?>>storniert</option>
                            </select>
                            <input type="submit" value="Filtern" class="loginBoxSubmit">
                        </form>
                        <h2 style="color: red">Keine Reservierungen mit diesem Filter gefunden.</h2>
                    </div>
                </div>
            <?php }
?>
        </div>
    </div>
</div>