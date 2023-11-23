<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Impressum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php'; ?>
    <!-- Content-->
    <h1>Impressum</h1>
    <div class="container" style="margin-bottom: 100px;">
        <div class="alert alert-light" role="alert" data-bs-theme="dark">
            <p>Hotel Tropicana GmbH</p>
            <p>Hotellerie</p>
            <p>UID-Nr: ATU42069420</p>
            <p>FN: 420420a</p>
            <p>FB-Gericht: Wien</p>
            <p>Sitz: 1110 Wien</p>
            <p>Kaiser-Ebersdorfer-Straße 69 | Austria</p>
            <p>Tel.:
                <a class="impressum-link" href="tel:+436604206969">+43 660 4206969</a>
            </p>
            <p>E-Mail:
                <a class="impressum-link" href="mailto:office@hoteltropicana.at">office@hoteltropicana.at</a>
            </p>
            <p>Mitglied der WKÖ</p>
            <p>Berufsrecht: Gewerbeordnung:
                <a class="impressum-link" href="https://www.ris.bka.gv.at/" target="_blank">www.ris.bka.gv.at</a>
            </p>
            <p>Bezirkshauptmannschaft Wien</p>
            <p>
            </p>
            <hr>
            <div class="alert-primary d-flex align-items-center" style="padding-top: 10px">
                <svg style="width: 50px; height: 90px;" class="bi flex-shrink-0 me-2" role="img" aria-label="Info:">
                    <use xlink:href="#info-fill" />
                </svg>
                <p>
                    Verbraucher haben die Möglichkeit, Beschwerden an die Online-Streitbeilegungsplattform der EU zu
                    richten:
                        <a class="impressum-link" href="http://ec.europa.eu/odr"
                        target="_blank">http://ec.europa.eu/odr</a>.<br>
                    Sie können allfällige Beschwerden auch an die oben angegebene E-Mail-Adresse richten.
                </p>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
            <symbol id="info-fill" viewBox="-5 0 30 26">
                <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
        </svg>
        <!-- Hotelverwaltung -->
        <h3>Hotelverwaltung:</h3>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 18rem;" data-bs-theme="dark">
                        <img src="../img/jan.gif" class="card-img-top" alt="Jan Halwax">
                        <div class="card-body">
                            <h5 class="card-title">
                                <h3>Jan Halwax</h3>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;" data-bs-theme="dark">
                        <img src="../img/armin.gif" class="card-img-top" alt="Armin Naseri">
                        <div class="card-body">
                            <h5 class="card-title">
                                <h3>Armin Naseri</h3>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php include '../utils/footer.php'; ?>
        <!-- Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>