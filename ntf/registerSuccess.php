<?php
header("Refresh: 3; url=index.php?page=login");
include 'inc/login.php';
?>
<div class="success">
    <div class="success__body">
        <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
        Erfolgreich registriert! Bitte loggen Sie sich ein.
    </div>
    <div class="success__progress"></div>
</div>