<?php

//TODO: Überprüfen, ob User Seite aufrufen darf (z.B. nur eingeloggte User dürfen auf Reservierungsseite)
//TODO: Fehlermeldungen verbessern (Notifications mit GET-Parametern (z.B. ?page=loginNtf&loginError=none oder ?page=registerNtf&registerError=none))
//TODO: Code aufräumen
//TODO: Code kommentieren
//TODO: SESSIONS und COOKIES überprüfen
//TODO: Adresseingabe bei Buchung hinzufügen (idk es steht nicht in der Angabe)
//TODO: Responsive Design Code verbessern
//TODO: Usability und Accessibility verbessern
//TODO: Design verschönern
//TODO: Editor-Notizen
//TODO: Titel   
//TODO: Durchsichtigkeit
//TODO: restliche Seiten anpassen
//TODO: UserManagement: Button für Aktivität

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'path' => '/',
    'domain' => 'localhost',
    'secure' => true,
    'httponly' => true
]);

session_start();

if (!isset($_SESSION['last_regeneration'])) {

    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} else {

    $interval = 60 * 30;

    if (time() - $_SESSION['last_regeneration'] > $interval) {

        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}
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
        "reservationManagement" => "inc/reservationManagement.php",
        "loginNtf" => "ntf/loginNtf.php",
        "registerNtf" => "ntf/registerNtf.php",
        "landingNtf" => "ntf/landingNtf.php",
        "buchungNtf" => "ntf/buchungNtf.php",
        "profileNtf" => "ntf/profileNtf.php",
        "newsNtf" => "ntf/newsNtf.php",
    ];

    if (isset($pages[$page])) {
        if (file_exists($pages[$page])) {
            include $pages[$page];
        }
    } else {
        include 'ntf/404.php';
    } ?>
    <!-- Footer-->
    <?php include 'utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>