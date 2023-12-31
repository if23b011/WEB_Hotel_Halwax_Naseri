<?php
//Error handling
if (isset($_GET["error"])) {
    if ($_GET["error"] == "noReservations") { ?>
        <div class="warning">
            <div class="warning__body">
                <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                Sie haben noch keine Reservierungen getätigt!
            </div>
            <div class="warning__progress"></div>
        </div>
        <?php
    }
}
if (!isset($_COOKIE["email"])) {
    header("Location: index.php?page=landing&error=notLoggedIn");
    exit();
}
?>
<div class="container" style="margin-bottom: 100px;">
    <h1 class="text-center mx-auto">Zimmerauswahl</h1>
    <?php $_SESSION["zimmer"] = "" ?>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xxl-4 justify-content-center">
            <div class="col mb-4 text-center">
                <div class="card mx-auto" style="width: 18rem;" data-bs-theme="dark">
                    <img src="res/img/zimmer1.jpg" class="card-img-top" alt="Zimmer 1">
                    <div class="card-body">
                        <h5 class="card-title">Einzelzimmer mit<br>Einzelbett</h5>
                        <p class="card-text">30€ / Nacht<br>⠀</p>
                        <a href="utils/reservierung1.php" class="btn btn-primary">Zur Reservierung</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4 text-center">
                <div class="card mx-auto" style="width: 18rem;" data-bs-theme="dark">
                    <img src="res/img/zimmer2.jpg" class="card-img-top" alt="Zimmer 3">
                    <div class="card-body">
                        <h5 class="card-title">Einzelzimmer mit Doppelbett</h5>
                        <p class="card-text">75€ / Nacht<br>Bestellservice inkludiert</p>
                        <a href="utils/reservierung2.php" class="btn btn-primary">Zur Reservierung</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4 text-center">
                <div class="card mx-auto" style="width: 18rem;" data-bs-theme="dark">
                    <img src="res/img/zimmer3.jpg" class="card-img-top" alt="Zimmer 2">
                    <div class="card-body">
                        <h5 class="card-title">Luxus Zimmer mit Jacuzzi<br>⠀</h5>
                        <p class="card-text">200€ / Nacht<br>Bestellservice inkludiert</p>
                        <a href="utils/reservierung3.php" class="btn btn-primary">Zur Reservierung</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4 text-center">
                <div class="card mx-auto" style="width: 18rem;" data-bs-theme="dark">
                    <img src="res/img/zimmer4.jpg" class="card-img-top" alt="Zimmer 4">
                    <div class="card-body">
                        <h5 class="card-title">Luxus Suite mit privatem Butler</h5>
                        <p class="card-text">500€ / Nacht<br>Bestellservice inkludiert</p>
                        <a href="utils/reservierung4.php" class="btn btn-primary">Zur Reservierung</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>