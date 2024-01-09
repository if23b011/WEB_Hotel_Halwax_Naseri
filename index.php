<?php
//* TODO: UserManagement & ReservationManagement: Buttons für Löschen und Bearbeiten
//* TODO: Notifcations auf normale Seiten geben 
//* TODO: Code durchschauen, aufräumen und kommentieren
//* TODO: Responsive Design Code verbessern
//* TODO: Usability und Accessibility verbessern
//* TODO: Editor-Notizen
//* TODO: Titel   
//* TODO: Durchsichtigkeit
//* TODO: restliche Seiten anpassen
session_start();
if (isset($_SESSION["admin"])) {
    setcookie("admin", true, time() + (86400 * 30), "/", null, false, true);
}

?>
<!doctype html>
<html lang="en">

<?php include "utils/head.php"; ?>


<body>
    <!-- Navigation-->
    <?php include "utils/navbar.php" ?>
    <!-- Content-->
    <?php
    $page = (isset($_GET["page"])) ? $_GET["page"] : "landing";
    $pages = [
        "404" => "inc/404.php",
        "buchung" => "inc/buchung.php",
        "faq" => "inc/faq.php",
        "impressum" => "inc/impressum.php",
        "landing" => "./inc/landing.php",
        "login" => "inc/login.php",
        "news" => "inc/news.php",
        "profile" => "inc/profile.php",
        "register" => "inc/register.php",
        "reservation" => "inc/reservation.php",
        "reservationManagement" => "inc/reservationManagement.php",
        "reservations" => "inc/reservations.php",
        "upload" => "inc/upload.php",
        "userManagement" => "inc/userManagement.php",
    ];

    if (isset($pages[$page])) {
        if (file_exists($pages[$page])) {
            include $pages[$page];
        }
    } else {
        include "inc/404.php";
    } ?>
    <!-- Footer-->
    <?php include "utils/footer.php"; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>