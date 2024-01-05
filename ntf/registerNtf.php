<?php
header("Refresh: 1; url=index.php?page=register");
include 'inc/register.php';
?>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "none") { ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Erfolgreich registriert! Bitte loggen Sie sich ein.
            </div>
            <div class="success__progress"></div>
        </div>
    <?php } else if ($_GET['error'] == "emailExists") { ?>
            <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Email existiert bereits!
                </div>
                <div class="warning__progress"></div>
            </div>
    <?php }
} ?>