<?php
header("Refresh: 3; url=index.php?page=profile");
include 'inc/profile.php';
?>
<?php
if ($_GET['error'] == "none") { ?>
    <div class="success">
        <div class="success__body">
            <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
            Erfolgreich eingeloggt!
        </div>
        <div class="success__progress"></div>
    </div>
    <?php
}