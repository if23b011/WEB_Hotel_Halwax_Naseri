<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Tropicana - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Navigation-->
    <?php include '../utils/navbar.php'; ?>
    <!-- Content-->
    <div class="container" style="margin-bottom: 100px;">
        <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request!";
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                <h1>Neues Passwort eingeben</h1>
                //TODO: Add error messages
                <form method="post" action="../utils/resetPassword.php">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="mb-1">
                                    <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                                </div>
                                <div class="mb-1">
                                    <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                                </div>
                                <div class="mb-1">
                                    <input data-toggle="password" class="form-control" type="password" name="password"
                                        placeholder="Passwort">
                                </div>
                                <div class="mb-1">
                                    <input data-toggle="password" class="form-control" type="password" name="passwordRepeat"
                                        placeholder="Passwort wiederholen">
                                </div>
                                <div class="d-grid gap-2">
                                    <input class="btn btn-primary" type="submit" value="Reset Password" name="resetPassword">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            }
        }
        if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "success") {
                echo '<p class="text-success">Check your e-mail!</p>';
            }
        }
        ?>
    </div>
    <!-- Footer-->
    <?php include '../utils/footer.php'; ?>
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>

</html>