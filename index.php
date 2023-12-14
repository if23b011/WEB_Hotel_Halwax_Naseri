<?php

session_start();

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
        "create-new-pasword" => "inc/create-new-password.php",
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
        "resetPassword" => "inc/resetPassword.php",
    ];

    if (isset($pages[$page])) {
        if (file_exists($pages[$page])) {
            include $pages[$page];
        }
    } else { ?>
        <h1>404 NOT FOUND</h1>
    <?php } ?>
    <!-- Footer-->
    <?php include 'utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>