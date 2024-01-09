<?php
//Error handling
if (isset($_GET["error"])) {
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
    } else if ($_GET["error"] == "noneAdminLogin") {
        ?>
            <div class="success">
                <div class="success__body">
                    <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                    Hallo Admin!
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
    } else if ($_GET["error"] == "notLoggedIn") { ?>
                        <div class="warning">
                            <div class="warning__body">
                                <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                                Du bist nicht eingeloggt!
                            </div>
                            <div class="warning__progress"></div>
                        </div>
        <?php
    } else if ($_GET["error"] == "noAccess") { ?>
                            <div class="warning">
                                <div class="warning__body">
                                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                                    Kein Zugriff!
                                </div>
                                <div class="warning__progress"></div>
                            </div>
        <?php
    } else if ($_GET["error"] == "noneLogout") { ?>
                                <div class="success">
                                    <div class="success__body">
                                        <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                                        Erfolgreich ausgeloggt
                                    </div>
                                    <div class="success__progress"></div>
                                </div>
        <?php
    }
} ?>
<div class="container" style="margin-bottom: 100px;">
    <h1>Hotel Tropicana</h1>
    <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="res/img/zimmer1.jpg" class="d-block w-100 img-fluid img-thumbnail" style="max-height: 550px;"
                    alt="Zimmer 1">
            </div>
            <div class="carousel-item">
                <img src="res/img/zimmer2.jpg" class="d-block w-100 img-fluid img-thumbnail" style="max-height: 550px;"
                    alt="Zimmer 2">
            </div>
            <div class="carousel-item">
                <img src="res/img/zimmer3.jpg" class="d-block w-100 img-fluid img-thumbnail" style="max-height: 550px;"
                    alt="Zimmer 3">
            </div>
            <div class="carousel-item">
                <img src="res/img/zimmer4.jpg" class="d-block w-100 img-fluid img-thumbnail" style="max-height: 550px;"
                    alt="Zimmer 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="d-grid gap-3 col-6 mx-auto">
        <?php
        if (isset($_COOKIE["email"])) { ?>
            <a class="btn btn-primary" href="index.php?page=buchung" role="button">Zu den Zimmern</a>
        <?php } else { ?>
            <a class="btn btn-primary" href="index.php?page=register" role="button">Zur Registrierung</a>
        <?php } ?>
    </div>
</div>