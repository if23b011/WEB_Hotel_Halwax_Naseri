<?php

session_start();
//TODO: Überprüfen, ob User Seite aufrufen darf (z.B. nur eingeloggte User dürfen auf Reservierungsseite)
//TODO: Fehlermeldungen verbessern
//TODO: Code aufräumen
//TODO: Code kommentieren
//TODO: SESSIONS und COOKIES überprüfen
//TODO: Userverwaltung für Admins (User löschen, etc.)
//TODO: Bei Zimmerbuchung überprüfen, ob Zimmer noch frei ist
//TODO: Adresseingabe bei Buchung hinzufügen
//TODO: Reservierungsverwaltung für Admins (Reservierungen stornieren, etc.)
//TODO: Responsive Design Code verbessern
//TODO: Usability und Accessibility verbessern
//TODO: Design verschönern
//TODO: restliche Seiten anpassen
?>
<!doctype html>
<html lang="en">

<?php include 'utils/head.php'; ?>


<body>
    <!-- Navigation-->
    <?php include 'utils/navbar.php' ?>
    <!-- Content-->
    <?php
    $page = (isset($_GET['page'])) ? $_GET['page'] : "landing";
    $pages = [
        "buchung" => "inc/buchung.php",
        "faq" => "inc/faq.php",
        "impressum" => "inc/impressum.php",
        "landing" => "./inc/landing.php",
        "login" => "inc/login.php",
        "news" => "inc/news.php",
        "upload" => "inc/upload.php",
        "profile" => "inc/profile.php",
        "register" => "inc/register.php",
        "reservation" => "inc/reservation.php",
        "reservations" => "inc/reservations.php",
        "userManagement" => "inc/userManagement.php",
        "loginSuccess" => "inc/loginSuccess.php",
        "registerSuccess" => "inc/registerSuccess.php",
        "noNews" => "inc/noNews.php",
    ];

    if (isset($pages[$page])) {
        if (file_exists($pages[$page])) {
            include $pages[$page];
        }
    } else { ?>
        <h1>404 NOT FOUND</h1>
        <?php
        header("Refresh: 1; url=index.php");
    } ?>
    <!-- Footer-->
    <?php include 'utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>