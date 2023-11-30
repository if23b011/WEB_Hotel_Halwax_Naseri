<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php'; ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Login</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="text-center">Noch nicht registriert? <a href="../sites/registrierung.php">Zur
                                    Registrierung</a></p>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse" required>
                        </div>
                        <div class="mb-3">
                            <input data-toggle="password" class="form-control" type="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="d-grid mx-auto mt-4">
            <div class="text-center">
                <?php
                $email = $password = "";
                if (!empty($_POST["email"])) {
                    $email = input($_POST["email"]);
                }

                if (!empty($_POST["password"])) {
                    $password = input($_POST["password"]);
                }

                function input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                if ($email == 'admin@gmail.com' && $password == 'admin') {
                    $_SESSION['login'] = true;
                    $_SESSION['admin'] = true;
                    $_SESSION['firstname'] = 'admin';
                    $_SESSION['lastname'] = 'admin';
                    $_SESSION['email'] = 'admin@gmail.com';
                    $_SESSION['date'] = '01.01.2000';
                    $_SESSION['password'] = 'admin';
                    echo '<h3>Willkommen ' . $_SESSION['firstname'] . '!</h3>';
                    echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                } else if ($email == $_SESSION['email'] && $password == $_SESSION['password'] && isset($_POST["email"]) && isset($_POST["password"])) {
                    $_SESSION['login'] = true;
                    echo '<h3>Willkommen zurück ' . $_SESSION['anrede'] . ' ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '!</h3>';
                    echo "<a class='btn btn-primary' role='button' href='../sites/profil.php'<h2>Zum Profil</h2></a>";
                } else if (isset($_POST["email"]) && isset($_POST["password"])) {
                    echo '<h3 style="color: red;">Du bist noch nicht registriert!</h3>';
                    echo "<a class='btn btn-primary' role='button' href='../sites/registrierung.php'<h2>Zur Registrierung</h2></a>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>