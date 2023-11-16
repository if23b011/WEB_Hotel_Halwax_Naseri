<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
</head>

<body>
    <nav class="navbar navbar-expand bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../sites/index.php">
                <img src="../img/tropicana.png" alt="Bootstrap" width="60" class="rounded-5">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php
                    if ($_SESSION["login"] == true) {
                        echo '<li class="nav-item">
                        <a class="nav-link" href="../sites/profil.php">
                            <h4>Profil</h4>
                        </a>';
                    } else if ($_SESSION["registered"] == true) {
                        echo '<li class="nav-item">
                        <a class="nav-link" href="../sites/login.php">
                            <h4>Login</h4>
                        </a>';
                    } else {
                        $_SESSION["registered"] = false;
                        $_SESSION["login"] = false;
                        echo '<li class="nav-item">
                        <a class="nav-link" href="../sites/registrierung.php">
                            <h4>Registrierung</h4>
                        </a>';
                    }
                    ?>
                    <!--<li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../sites/registrierung.php">
                            <h4>Registrierung</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../sites/login.php">
                            <h4>Login</h4>
                        </a>
                    </li>
                -->
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>