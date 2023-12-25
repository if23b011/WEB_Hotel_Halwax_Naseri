<?php
header("Refresh: 3; url=index.php?page=profile");
include 'inc/profile.php';
?>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "nonePassword") { ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Erfolgreich Passwort geändert!
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    }
}