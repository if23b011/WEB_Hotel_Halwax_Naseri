<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body style="background-image: url(../img/tropicana.jpg);">
    <?php
    if (!isset($_SESSION["login"])) {
        $_SESSION["login"] = false;
    }
    if (!isset($_SESSION["admin"])) {
        $_SESSION["admin"] = false;
    }
    ?>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Hotel Tropicana - hier werden Urlaubsträume wahr!</h1>
        <!-- TODO: Zimmer - Carousel implementieren-->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 style="margin-bottom: 27rem; margin-right: 5rem; color: black;">Einzelzimmer mit Einzelbett
                        </h1>
                    </div>
                    <img src="../img/zimmer1.jpg" class="d-block w-100" alt="Zimmer 1" style="height: 35rem;">
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 style="margin-bottom: 29rem; color: black;">Einzelzimmer mit Doppelbett</h1>
                    </div>
                    <img src="../img/zimmer2.jpg" class="d-block w-100" alt="Zimmer 2" style="height: 35rem;">
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 style="margin-bottom: 24rem; margin-right: 12rem; color: black; ">Luxus Zimmer<br>mit
                            Jacuzzi</h1>
                    </div>
                    <img src="../img/zimmer3.jpg" class="d-block w-100" alt="Zimmer 3" style="height: 35rem;">
                </div>
                <div class="carousel-item">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 style="margin-bottom: 22rem; margin-right: 10rem; color: black;">Luxus Suite mit privatem
                            Butler</h1>
                    </div>
                    <img src="../img/zimmer4.jpg" class="d-block w-100" alt="Zimmer 4" style="height: 35rem">
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
            if ($_SESSION["login"] == true) {
                echo "<a class='btn btn-primary' href='../sites/buchung.php' role='button'>Zu den Zimmern</a>";
            } else {
                echo "<a class='btn btn-primary' href='../sites/registrierung.php' role='button'>Zur Registrierung</a>";
            }
            ?>
        </div>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>