<?php
header("Refresh: 3; url=index.php?page=login");
include 'inc/login.php';
?>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == "none") { ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Registrierung erfolgreich! Bitte loggen Sie sich ein.
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    } else if ($_GET['error'] == "wrongPassword") { ?>
            <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Falsches Passwort
                </div>
                <div class="warning__progress"></div>
            </div>
        <?php
    } else if ($_GET['error'] == "wrongEmail") { ?>
                <div class="warning">
                    <div class="warning__body">
                        <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                        Benutzer existiert nicht
                    </div>
                    <div class="warning__progress"></div>
                </div>
        <?php
    } else if ($_GET['error'] == "notActive") { ?>
                    <div class="warning">
                        <div class="warning__body">
                            <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                            Benutzer ist nicht aktiviert
                        </div>
                        <div class="warning__progress"></div>
                    </div>
        <?php
    }
} ?>