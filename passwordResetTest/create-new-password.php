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