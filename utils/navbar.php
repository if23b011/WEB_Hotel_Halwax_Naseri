<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
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
                        <a class="nav-link" href="../utils/logout.php">
                        <h4 style="color: white">Logout</h4>
                        </a>
                        <li class="nav-item">
                        <a class="nav-link" href="../sites/profil.php">
                        <h4 style="color: white">Profil</h4>
                        </a> 
                        <li class="nav-item">
                        <a class="nav-link" href="../sites/buchung.php">
                        <h4 style="color: white">Reservierung</h4>
                        </a>';
                    } else {
                        $_SESSION["login"] = false;
                        echo '<li class="nav-item">
                        <a class="nav-link" href="../sites/login.php">
                        <h4 style="color: white">Login</h4>
                        </a>';
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../sites/news.php">
                            <h4 style="color: white">News</h4>
                        </a>
                    </li>
                    <?php
                    if ($_SESSION["admin"] == true) {
                        echo '<li class="nav-item">
<a class="nav-link" href="../sites/newsupload.php">
<h4 style="color: white">Upload</h4>
</a> ';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>