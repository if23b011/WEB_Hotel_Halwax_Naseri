<?php

session_start();

//TODO: Headers wenn man falsch auf eine Seite kommt
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

<body>
    <?php
    ?>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Hotel Tropicana - hier werden Urlaubsträume wahr!</h1>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "noNews") {
                echo '<h1 class="text-danger">Keine News vorhanden</h1>';
                header("Refresh: 1; url=../sites/index.php");
            }
        }
        ?>
        <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../img/zimmer1.jpg" class="d-block w-100 img-fluid" alt="Zimmer 1">
                </div>
                <div class="carousel-item">
                    <img src="../img/zimmer2.jpg" class="d-block w-100 img-fluid" alt="Zimmer 2">
                </div>
                <div class="carousel-item">
                    <img src="../img/zimmer3.jpg" class="d-block w-100 img-fluid" alt="Zimmer 3">
                </div>
                <div class="carousel-item">
                    <img src="../img/zimmer4.jpg" class="d-block w-100 img-fluid" alt="Zimmer 4">
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
            if (isset($_COOKIE["email"])) {
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