<?php
header("Refresh: 3; url=index.php?page=reservations");
include 'inc/reservations.php';
?>
<div style="overflow: hidden; height: 100vh;">
    <div class="success">
        <div class="success__body">
            <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
            Buchung erfolgreich!
        </div>
        <div class="success__progress"></div>
    </div>
</div>