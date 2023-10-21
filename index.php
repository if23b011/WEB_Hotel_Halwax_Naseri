<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-image: url(img/tropicana.jpg);">
    <!-- Navigation-->
    <?php include 'navbar.php'; ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Hotel Tropicana - hier werden Urlaubsträume wahr!</h1>
        <!-- TODO: Carousel implementieren-->
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-xl-3">
                <div class="col">
                    <div class="card text-bg-dark mb-3">
                        <div class="ratio ratio-16x9">
                            <img src="img/parkplatz.jpg" class="card-img-top" alt="Parkplätze">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Parkplätze</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-bg-dark mb-3">
                        <div class="ratio ratio-16x9">
                            <img src="img/frühstück.jpg" class="card-img-top" alt="Frühstück">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Frühstück</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-bg-dark mb-3">
                        <div class="ratio ratio-16x9">
                            <img src="img/haustiere.jpg" class="card-img-top" alt="Mitnahme von Haustieren">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Mitnahme von Haustieren</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php include 'footer.php'; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>