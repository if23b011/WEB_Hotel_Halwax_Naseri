<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php'; ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Login</h1>
        <form method="post" action="../sites/logined.php">
            <div class="container" style="margin-bottom: 100px;">
                <div class="container text-center">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="email" placeholder="E-Mail-Adresse" value="<?php if (isset($_SESSION["email"])) {
                            echo $_SESSION["email"];
                        } else {
                            echo "";
                        } ?>" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Passwort" required>
                    </div>
                    <div class="d-grid gap-2">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>