<div class="container" style="margin-bottom: 100px;">
    <h1>Passwort zurücksetzen</h1>
    <form method="post" action="../utils/resetRequest.php">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-1">
                        <input type="text" class="form-control" name="email" placeholder="E-Mail-Adresse">
                    </div>
                    <div class="d-grid gap-2">
                        <input class="btn btn-primary" type="submit" value="Submit" name="resetRequest">
                    </div>
                    <?php
                    if (isset($_GET["reset"])) {
                        if ($_GET["reset"] == "success") {
                            echo '<p class="text-success">Check your e-mail!</p>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>