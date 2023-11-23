<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Reservierung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Reservierung</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="d-grid gap-3 col-6 mx-auto">
                    <div class="mb-3">
                        <input type="text" id="disabledTextInput" class="form-control"
                            value="<?php echo $_SESSION['zimmer'] ?>" disabled>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 align-items-start">
                        <div class="col">
                            <div class="mb-3">
                                <label for="date" class="form-label">
                                    <p>Anreisedatum</p>
                                </label>
                                <input type="date" class="form-control" name="arrivalDate"
                                    value="<?php echo $arrivalDate; ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="date" class="form-label">
                                    <p>Abreisedatum</p>
                                </label>
                                <input type="date" class="form-control" name="departureDate"
                                    value="<?php echo $departureDate; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="breakfast">
                        <label class="form-check-label" for="flexCheckDefault">
                            <p>Frühstück (Aufpreis von 5€ / Nacht)</p>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="parking">
                        <label class="form-check-label" for="flexCheckDefault">
                            <p>Parkplatz (Aufpreis von 10€ / Nacht)</p>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="pets">
                        <label class="form-check-label" for="flexCheckDefault">
                            <p>Mitnahme von Haustieren (Aufpreis von 15€)</p>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">
                            <p>Bemerkungen</p>
                        </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            name="comments"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <input class="btn btn-primary" type="submit" value="Buchen">
                    </div>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $arrival = $departure = $arrivalDate = $departureDate = $breakfast = $parking = $pets = $comments = "";
                        if (isset($_POST["arrivalDate"])) {
                            $arrival = input($_POST["arrivalDate"]);
                            $arrivalDate = date("d.m.Y", strtotime($arrival));
                        }
                        if (isset($_POST["departureDate"])) {
                            $departure = input($_POST["departureDate"]);
                            $departureDate = date("d.m.Y", strtotime($departure));
                        }
                        if (isset($_POST["breakfast"])) {
                            $breakfast = "inkludiert";
                        } else {
                            $breakfast = "nicht inkludiert";
                        }
                        if (isset($_POST["parking"])) {
                            $parking = "inkludiert";
                        } else {
                            $parking = "nicht inkludiert";
                        }
                        if (isset($_POST["pets"])) {
                            $pets = "inkludiert";
                        } else {
                            $pets = "nicht inkludiert";
                        }
                        if (isset($_POST["comments"])) {
                            $comments = input($_POST["comments"]);
                        }
                        $_SESSION['arrivalDate'] = $arrivalDate;
                        $_SESSION['departureDate'] = $departureDate;
                        $_SESSION['breakfast'] = $breakfast;
                        $_SESSION['parking'] = $parking;
                        $_SESSION['pets'] = $pets;
                        $_SESSION['comments'] = $comments;
                    }
                    if (isset($departureDate) && isset($arrivalDate)) {

                        $timestamp = time();
                        $today = date("d.m.Y", $timestamp);
                        if ($arrivalDate <= $today) {
                            echo '<p style="color: red;">Anreisedatum muss nach ' . $today . ' sein!</p>';
                        } else if ($departure <= $arrival) {
                            echo '<p style="color: red;">Anreisedatum muss vor Abreisedatum liegen!</p>';
                        } else {
                            echo '<div class="alert alert-success" role="alert">Deine Reise vom ' . $arrivalDate . ' bis ' . $departureDate .
                                ' wurde mit folgenden Bemerkungen gebucht: Frühstück ' . $breakfast . ', Parkplatz ' . $parking .
                                ', Haustiere ' . $pets . '</div>';
                            echo '<a href="../sites/reservierungen.php"><h2>Meine Reservierungen</h2></a>';
                        }
                    }

                    function input($data)
                    {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    ?>
                </div>
        </form>


        <!-- Footer-->
        <?php include '../utils/footer.php'; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>