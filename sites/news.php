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
        <div class="d-grid col-12 mx-auto">
            <div class="mb-3 container">
                <?php
                if (isset($_GET["upload"])) {
                    if ($_GET["upload"] == "success") {
                        echo '<p class="text-success">News hochgeladen</p>';
                    }
                }
                ?>
                <?php
                require_once '../utils/dbaccess.php';
                $sql = "SELECT * FROM news ORDER BY newsdate DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    ?>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="text-center">
                            <h2>
                                <?php
                                echo $row["title"] . "<br>";
                                ?>
                            </h2>
                        </div>
                        <div class="text-center mb-4">
                            <?php
                            if (!empty($row["filePath"])) {
                                echo '<img src="' . $row["filePath"] . '" alt="Thumbnail" class="img-fluid img-thumbnail " style="max-width: 50%;">';
                            }
                            ?>
                        </div>
                        <div class="alert alert-light" role="alert" data-bs-theme="dark">
                            <p style="text-align: justify;">
                                <?php
                                //TODO: Textausgabe fixen
                                echo $row["text"] . "<br>";
                                ?>
                            </p>
                            <h3>
                                <?php
                                $newsDate = date("d.m.Y H:i:s", strtotime($row["newsDate"]));
                                echo "News vom " . $newsDate . "<br>";
                                ?>
                            </h3>
                        </div>
                        <?php
                    }
                } else {
                    echo '
                <h3>Keine News vorhanden!</h3>
                <p>Es sind keine News vorhanden.</p>
                <hr>
                <p class="mb-0">Bitte versuchen Sie es später erneut.</p>
                </div>';
                }


                ?>
            </div>
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