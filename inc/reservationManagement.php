<div style="margin-bottom: 100px;">
    <?php
    require_once 'utils/dbaccess.php';
    require_once 'utils/functions.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reservationId = $_POST['reservationId'];
        $room = $_POST['zimmer'];
        $arrival = $_POST['arrivalDate'];
        $departure = $_POST['departureDate'];
        $breakfast = $_POST['breakfast'];
        $parking = $_POST['parking'];
        $pets = $_POST['pets'];
        $comments = $_POST['comments'];

        $sql = "UPDATE reservations SET room=?, arrival=?, departure=?, breakfast=?, parking=?, pets=?, comments=? WHERE reservationId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssssi", $room, $arrival, $departure, $breakfast, $parking, $pets, $comments, $reservationId);
        $stmt->execute();
    }
    $sql = "SELECT * FROM reservations";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div class="login-box d-flex justify-content-center align-items-center" style="width: 100%; max-width: 42rem;">
            <div style="text-align: center;">
                <h1>Reservierungen</h1>
                <?php
                while ($row = $result->fetch_assoc()) { ?>
                    <?php
                    $reservationId = $row["reservationId"];
                    $room = $row["room"];
                    $arrival = $row["arrivalDate"];
                    $departure = $row["departureDate"];
                    $breakfast = $row["breakfast"];
                    $parking = $row["parking"];
                    $pets = $row["pets"];
                    $comments = $row["comments"]; ?>
                    <form method="post" id="form<?php echo $reservationId; ?>"
                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?page=reservationManagement"); ?>">
                        <a>
                            <span></span>
                            <h2>
                                <?php
                                echo $row["reservationId"];
                                ?>
                            </h2>
                        </a>
                        <input type="text" name="reservationId" value="<?php echo $reservationId ?>" hidden>
                        <div class="user-box">
                            <input type="text" name="zimmer" value="<?php echo $room ?>">
                            <label>Zimmer</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="arrivalDate" value="<?php echo $arrival ?>">
                            <label>Anreise</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="departureDate" value="<?php echo $departure ?>">
                            <label>Abreise</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="breakfast" value="<?php echo $breakfast ?>">
                            <label>Frühstück</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="parking" value="<?php echo $parking ?>">
                            <label>Parkplatz</label>
                        </div>
                        <div class="user-box">
                            <input type="text" name="pets" value="<?php echo $pets ?>">
                            <label>Haustiere
                        </div>
                    </form>
                <?php }
    } ?>
        </div>
    </div>
</div>