<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
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

    <div class="container" style="margin-bottom: 100px;">
        <h1>Login</h1>
        <form action="index.php" method="post">
            <div class="container" style="margin-bottom: 100px;">
                <div class="container text-center">
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email" placeholder="name@mail.com"
                            required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password2" placeholder="Passwort"
                            required>
                    </div>
                    <div class="d-grid gap-2">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
            </div>
    </div>
    </form>
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