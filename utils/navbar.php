<nav class="navbar navbar-expand-xl bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" aria-current="page" href="index.php">
            <img src="res/img/tropicana.png" alt="Bootstrap" width="60" class="rounded-5">
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php
                if (isset($_COOKIE["email"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=buchung">
                            <h4 style="color: white">Reservierung</h4>
                        </a>
                    <?php } else {
                    $_SESSION["login"] = false; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">
                            <h4 style="color: white">Login</h4>
                        </a>
                    <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?page=news">
                        <h4 style="color: white">News</h4>
                    </a>
                </li>
                <?php
                if (isset($_COOKIE["admin"]) && $_COOKIE["admin"] == true) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=upload">
                            <h4 style="color: white">Upload</h4>
                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=userManagement">
                            <h4 style="color: white">User</h4>
                        </a>
                    <?php } ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_COOKIE["email"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=profile">
                            <h4 style="color: white">Profil</h4>
                        </a>
                    <?php } ?>
            </ul>
        </div>
    </div>
</nav>