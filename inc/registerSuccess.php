<?php
header("Refresh: 3; url=index.php?page=login");
include 'login.php';
?>
<div class="notification">
    <div class="notification__body">
        <img src="res/img/check-circle.svg" alt="Success" class="notification__icon">
        Erfolgreich registriert! Bitte loggen Sie sich ein.
    </div>
    <div class="notification__progress"></div>
</div>