<?php
//TODO: Speichern der News in der Datenbank
?>
<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Tropicana - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php' ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <h1>Dein Upload</h1>
        <?php
        //Bildupload fixen
        $newsDate = date("d.m.Y", time());
        require_once '../utils/dbaccess.php';
        $time = time();
        $newsDate = date("Y-m-d H:i", strtotime($newsDate));
        $sql = "SELECT userId FROM users WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
            return;
        }
        mysqli_stmt_bind_param($stmt, "s", $_SESSION["email"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $FK_userId = $row['userId'];
        mysqli_stmt_close($stmt);

        //TODO:Bildupload fixen
        if (isset($_POST["fileToUpload"])) {
            echo "fileToUpload is set";
            $target_dir = "../img/thumbnails/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_FILES["fileToUpload"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<p>Sorry, your file was not uploaded.</p>";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    upload($conn, $_POST["title"], $_POST["text"], $target_file, $newsDate, $FK_userId);
                } else {
                    echo "<p>Sorry, there was an error uploading your file.</p>";
                    // Fügen Sie die folgende Zeile für detailliertere Fehlerinformationen hinzu
                    echo "Error: " . $_FILES["fileToUpload"]["error"];
                }

            }
        } else {
            upload($conn, $_POST["title"], $_POST["text"], null, $newsDate, $FK_userId);
        }

        function upload($conn, $title, $text, $target_file, $newsDate, $FK_userId)
        {
            require_once '../utils/dbaccess.php';
            $newsDate = date("Y-m-d H:i");
            $sql = "INSERT INTO news (title, text, filepath, newsDate, FK_userId) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "SQL statement failed";
                return;
            }
            mysqli_stmt_bind_param($stmt, "ssssi", $title, $text, $target_file, $newsDate, $FK_userId);
            mysqli_stmt_execute($stmt);
            header("Location: ../sites/news.php?upload=success");
        }
        ?>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>