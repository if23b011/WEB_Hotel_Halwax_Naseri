<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Buchung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Zimmerauswahl</h1>
        <?php $_SESSION['zimmer'] = '' ?>
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-4 align-items-start">
                <div class="col">
                    <div class="card" class="" style="width: 18rem;" data-bs-theme="dark">
                        <img src="../img/zimmer1.jpg" class="card-img-top" alt="Zimmer 1">
                        <div class="card-body">
                            <h5 class="card-title">Einzelzimmer mit<br>Einzelbett</h5>
                            <p class="card-text">30€ / Nacht<br>⠀</p>
                            <a href="../utils/reservierung1.php" class="btn btn-primary">Zur Reservierung</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;" data-bs-theme="dark">
                        <img src="../img/zimmer2.jpg" class="card-img-top" alt="Zimmer 3">
                        <div class="card-body">
                            <h5 class="card-title">Einzelzimmer mit Doppelbett</h5>
                            <p class="card-text">75€ / Nacht<br>Bestellservice inkludiert</p>
                            <a href="../utils/reservierung2.php" class="btn btn-primary">Zur Reservierung</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;" data-bs-theme="dark">
                        <img src="../img/zimmer3.jpg" class="card-img-top" alt="Zimmer 2">
                        <div class="card-body">
                            <h5 class="card-title">Luxus Zimmer mit Jacuzzi<br>⠀</h5>
                            <p class="card-text">200€ / Nacht<br>Bestellservice inkludiert</p>
                            <a href="../utils/reservierung3.php" class="btn btn-primary">Zur Reservierung</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;" data-bs-theme="dark">
                        <img src="../img/zimmer4.jpg" class="card-img-top" alt="Zimmer 4">
                        <div class="card-body">
                            <h5 class="card-title">Luxus Suite mit privatem Butler</h5>
                            <p class="card-text">500€ / Nacht<br>Bestellservice inkludiert</p>
                            <a href="../utils/reservierung4.php" class="btn btn-primary">Zur Reservierung</a>
                        </div>
                    </div>
                </div>
            </div>
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