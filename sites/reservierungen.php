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

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Meine Buchungen</h1>
        <p>
            <?php
            echo 'Zimmer: ' . $_SESSION['zimmer'] . '<br>';
            echo 'Anreisedatum: ' . $_SESSION['arrivalDate'] . '<br>';
            echo 'Abreisedatum: ' . $_SESSION['departureDate'] . '<br>';
            echo 'Frühstück: ' . $_SESSION['breakfast'] . '<br>';
            echo 'Parkplatz: ' . $_SESSION['parking'] . '<br>';;
            echo 'Haustiere: ' . $_SESSION['pets'] . '<br>';
            echo 'Bemerkungen: ' .$_SESSION['comments'];
            ?>
        </p>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>