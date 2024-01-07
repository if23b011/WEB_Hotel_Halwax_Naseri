<?php
header("Refresh: 1; url=index.php?page=buchung");
include "inc/buchung.php";
?>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "noReservations") { ?>
        <div class="warning">
            <div class="warning__body">
                <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                Sie haben noch keine Reservierungen getätigt!
            </div>
            <div class="warning__progress"></div>
        </div>
        <?php
    }
}