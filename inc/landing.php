<div class="container" style="margin-bottom: 100px;">
    <h1>Hotel Tropicana - hier werden Urlaubsträume wahr!</h1>
    <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/zimmer1.jpg" class="d-block w-100 img-fluid" alt="Zimmer 1">
            </div>
            <div class="carousel-item">
                <img src="img/zimmer2.jpg" class="d-block w-100 img-fluid" alt="Zimmer 2">
            </div>
            <div class="carousel-item">
                <img src="img/zimmer3.jpg" class="d-block w-100 img-fluid" alt="Zimmer 3">
            </div>
            <div class="carousel-item">
                <img src="img/zimmer4.jpg" class="d-block w-100 img-fluid" alt="Zimmer 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="d-grid gap-3 col-6 mx-auto">
        <?php
        if (isset($_COOKIE["email"])) { ?>
            <a class='btn btn-primary' href='index.php?page=buchung' role='button'>Zu den Zimmern</a>
        <?php } else { ?>
            <a class='btn btn-primary' href='index.php?page=register' role='button'>Zur Registrierung</a>
        <?php } ?>
    </div>
</div>