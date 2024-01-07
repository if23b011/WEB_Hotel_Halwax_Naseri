<?php
header("Refresh: 1; url=index.php?page=reservations");
include "inc/reservations.php";
?>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "noneReservation") { ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Buchung erfolgreich!
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    } else if ($_GET["error"] == "noReservations") { ?>
            <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Sie haben noch keine Reservierungen getätigt!
                </div>
                <div class="warning__progress"></div>
            </div>
        <?php
    }
} ?>