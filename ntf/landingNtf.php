<?php
header("Refresh: 1; url=index.php");
include 'inc/landing.php';
?>
<?php if (isset($_GET["error"])) {
    if ($_GET["error"] == "noneLogin") {
        ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                Erfolgreich eingeloggt!
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    } else if ($_GET["error"] == "noNews") {
        ?>
            <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Keine News vorhanden
                </div>
                <div class="warning__progress"></div>
            </div>
        <?php
    } else if ($_GET["error"] == "noneAdminLogin") {
        $_SESSION['admin'] = true;
        ?>
                <div class="success">
                    <div class="success__body">
                        <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                        Erfolgreich eingeloggt!
                    </div>
                    <div class="success__progress"></div>
                </div>
        <?php
    } else if ($_GET["error"] == "stmtFailed") {
        ?>
                    <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    Error 
                </div>
                <div class="warning__progress"></div>
            </div>
        <?php
    }
} ?>