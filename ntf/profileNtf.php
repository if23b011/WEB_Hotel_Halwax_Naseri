<?php
header("Refresh: 1; url=index.php?page=profile");
include "inc/profile.php";
?>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nonePassword") { ?>
        <div class="warning">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Erfolgreich Passwort geändert!
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    } else if ($_GET["error"] == "alreadyLoggedIn") { ?>
            <div class="warning">
                <div class="warning__body">
                <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Du bist bereits eingeloggt!
                </div>
                <div class="warning__progress"></div>
            </div>
        <?php
    }
}

