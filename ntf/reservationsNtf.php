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
    }
}