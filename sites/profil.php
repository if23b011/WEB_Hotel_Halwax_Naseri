<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Profil!</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 align-items-start">
                    <div class="col">
                        <div class=" mb-3">
                            <input type="text" class="form-control" name="firstname" placeholder="Vorname" tabindex="1"
                                value="<?php echo $_SESSION["firstname"]; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control" name="date" tabindex="3"
                                value="<?php echo $_SESSION["date"]; ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="lastname" placeholder="Nachname" tabindex="2"
                                value="<?php echo $_SESSION["lastname"]; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse"
                                tabindex="4" value="<?php echo $_SESSION["email"]; ?>">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <input class="btn btn-primary" type="submit"
                        value="Nach Klicken des Buttons Wesbeite neuladen um Änderungen zu sehen" tabindex="7">
                </div>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION["firstname"] = $_POST["firstname"];
                $_SESSION["lastname"] = $_POST["lastname"];
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["date"] = $_POST["date"];
            }
            ?>
        </form>
        <form action="login.php">
            <div class="d-grid gap-2 col-4 mx-auto">
                <input type="submit" class="btn btn-outline-danger" value="Logout"></input>
            </div>
        </form>

    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>