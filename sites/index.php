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
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Hotel Tropicana - hier werden Urlaubsträume wahr!</h1>
        <!-- TODO: Carousel implementieren-->
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../img/frühstück.jpg" class="d-block w-100" alt="Frühstück" style="height: 35rem;">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Frühstück</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../img/parkplätze.jpg" class="d-block w-100" alt="Parkplatz" style="height: 35rem;">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Parkplatz</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../img/haustier.jpg" class="d-block w-100" alt="Haustiere" style="height: 35rem">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Haustiere</h1>
                    </div>
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
        <!-- Footer-->
        <?php include '../utils/footer.php'; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>