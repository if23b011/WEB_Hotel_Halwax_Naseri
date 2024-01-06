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
                if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=buchung">
                            <h4 style="color: white">Reservierung</h4>
                        </a>
                    </li>
                <?php } else {
                    $_SESSION["login"] = false; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">
                            <h4 style="color: white">Login</h4>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?page=news">
                        <h4 style="color: white">News</h4>
                    </a>
                </li>
                <?php
                if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {
                    ?>
                    <div class="btn-group">
                        <a class="btn btn-dark" href="index.php?page=userManagement" role="button">
                            <h4 style="color: white">User</h4>
                            </h4>
                        </a>
                        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="index.php?page=reservationManagement">
                                    <h4 style="color: white">Reservierungen</h4>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) {
                    ?>
                    <div class="btn-group">
                        <a class="btn btn-dark" href="index.php?page=profile" role="button">
                            <h4 style="color: white">
                                <?php echo strstr($_SESSION["email"], '@', true); ?>
                            </h4>
                        </a>
                        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" style="margin-left: -50px">
                            <li>
                                <a class="dropdown-item" href="utils/logout.php">
                                    <h4 style="color: red">Logout</h4>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>