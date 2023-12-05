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
        <h1>Meine Reservierungen</h1>
        <div class="d-grid col-12 mx-auto">
            <div class="mb-3 container">
                <?php
                //TODO: Reservierungen aus Datenbank auslesen und anzeigen
                require_once '../utils/dbaccess.php';
                $sql = "SELECT userId FROM users WHERE email = ?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed";
                    return;
                }
                mysqli_stmt_bind_param($stmt, "s", $_SESSION["email"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
                $FK_userId = $row['userId'];
                mysqli_stmt_close($stmt);

                $sql = "SELECT * FROM reservations WHERE FK_userId = ?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statement failed";
                    return;
                }
                mysqli_stmt_bind_param($stmt, "i", $FK_userId);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($result->num_rows == 0) {
                    header("Location: ../sites/buchung.php?reservation=none");
                    exit();
                } else {
                    $number = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $room = $row['room'];
                        $arrivalDate = $row['arrivalDate'];
                        $departureDate = $row['departureDate'];
                        $breakfast = $row['breakfast'];
                        $parking = $row['parking'];
                        $pets = $row['pets'];
                        $comments = $row['comments'];
                        $reservationDate = $row['reservationDate'];
                        $totalCost = $row['totalCost'];
                        $status = $row['status'];
                        if ($breakfast == 1) {
                            $breakfast = "inkludiert";
                        } else {
                            $breakfast = "nicht inkludiert";
                        }
                        if ($parking == 1) {
                            $parking = "inkludiert";
                        } else {
                            $parking = "nicht inkludiert";
                        }
                        if ($pets == 1) {
                            $pets = "inkludiert";
                        } else {
                            $pets = "nicht inkludiert";
                        }
                        if (empty($comments)) {
                            $comments = "keine";
                        }
                        echo '<p>Reservierungsnummer: ' . $number . '<br></p>';
                        echo '<p>Zimmer: ' . $room . '<br></p>';
                        echo '<p>Anreise: ' . date("d.m.Y", strtotime($arrivalDate)) . '<br></p>';
                        echo '<p>Abreise: ' . date("d.m.Y", strtotime($departureDate)) . '<br></p>';
                        echo '<p>Frühstück: ' . $breakfast . '<br></p>';
                        echo '<p>Parkplatz: ' . $parking . '<br></p>';
                        echo '<p>Haustiere: ' . $pets . '<br></p>';
                        echo '<p>Kommentare: ' . $comments . '<br></p>';
                        echo '<p>Reservierungsdatum: ' . date("d.m.Y", strtotime($reservationDate)) . '<br></p>';
                        echo '<p>Gesamtkosten: ' . $totalCost . '€<br></p>';
                        echo '<p>Status: ' . $status . '<br></p>';
                        echo '<p>------------------------<br></p>';
                        $number++;
                    }
                }
                mysqli_stmt_close($stmt);
                ?>
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