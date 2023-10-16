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
    <!-- Navbar-->
    <nav class="navbar navbar-expand bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/tropicana.png" alt="Bootstrap" width="60" class="rounded-5">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="registrierung.php">
                            <h4>Registrierung</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <h4>Login</h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1 class="text-center">Hotel Tropicana - hier werden Urlaubsträume wahr!</h1>
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

        <!-- TODO: Buchung implementieren-->
        <div class="container text-center">
            <a class="btn btn-primary btn-lg" href="registrierung.php" role="button">Buchen</a>
        </div>
    </div>

    <nav class="navbar navbar-expand bg-dark border-top border-body fixed-bottom" data-bs-theme="dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">
                            <h4>FAQs</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="impressum.php">
                            <h4>Impressum</h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>