<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Registrierung</title>
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

    <!--TODO: Für Handy anpassen--> 
    <div class="container" style="margin-bottom: 100px;">
        <h1>Registrierung</h1>
        <form action="success.php" method="post">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 align-items-start">
                    <div class="col">
                        <div class="mb-3">
                            <select class="form-select" name="anrede">
                                <option selected disabled>
                                    <p>Anrede</p>
                                </option>
                                <option value="1">
                                    <p>Herr</p>
                                </option>
                                <option value="2">
                                    <p>Frau</p>
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="firstname" placeholder="Vorname" required
                                tabindex="2">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Passwort" required
                                tabindex="4">
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control" name="date" required tabindex="6">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="E-Mail-Adresse" required
                                tabindex="1">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="lastname" placeholder="Nachname" required
                                tabindex="3">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password2"
                                placeholder="Passwort wiederholen" required tabindex="5">
                        </div>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" value="Submit" tabindex="7">
                        </div>
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