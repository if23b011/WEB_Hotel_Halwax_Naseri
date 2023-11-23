<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div style="margin-bottom: 100px;">
        <h1>NEWS</h1>
        <div class="d-grid gap-3 col-6 mx-auto">
            <div class="text-center">
                <h2>
                    <?php
                    echo $_SESSION["title"];
                    ?>
                </h2>
            </div>
            <div class="text-center">
                <?php
                echo '<img src="../img/thumbnails/' . $_SESSION["fileToUpload"] . '" alt="Bild" width="500" height:"auto" class="img-thumbnail">';
                ?>
            </div>
            <p style="text-align: justify;">
                <?php
                echo $_SESSION["text"] . "<br>";
                ?>
            </p>
            <h3>
                <?php
                echo "News vom " . $_SESSION["newsDate"];
                ?>
            </h3>
        </div>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>