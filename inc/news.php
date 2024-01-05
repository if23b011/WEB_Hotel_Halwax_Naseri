<?php
require_once 'utils/dbaccess.php';
if (isset($_GET["upload"])) {
    if ($_GET["upload"] == "success") { ?>
        <p class="text-success">News hochgeladen</p>
        <?php
        header("Refresh: 1; url=index.php?page=news");
    }
}
?>
<?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {
    $sql = "SELECT * FROM news ORDER BY newsDate DESC";
} else {
    $sql = "SELECT * FROM news where newsOnline = 1 ORDER BY newsDate DESC";
}
$result = $conn->query($sql); ?>
<?php if ($result->num_rows < 0) {
    header("Location: index.php?page=landingNtf&error=noNews");
} else {
    ?>
    <div style="margin-bottom: 100px;">
        <div class="login-box d-flex justify-content-center align-items-center" style="width: 100%; max-width: 75rem;">
            <div style="text-align: center;">
                <h1 style="color: grey">Die neuesten News des Hotel Tropicana</h1>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="text-center mb-4">
                        <div class="container">
                            <?php
                            if (!empty($row["filePath"])) {
                                echo '<img src="' . $row["filePath"] . '" alt="Thumbnail" class="img-thumbnail img-fluid">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2>
                            <?php
                            echo $row["title"] . "<br>";
                            ?>
                        </h2>
                    </div>
                    <div class="alert alert-light" role="alert" data-bs-theme="dark">
                        <p style="text-align: justify;">
                            <?php
                            echo $row["text"] . "<br>";
                            ?>
                        </p>
                        <h3>
                            <?php
                            $newsDate = date("d.m.Y H:i:s", strtotime($row["newsDate"]));
                            echo "News vom " . $newsDate . "<br>";
                            ?>
                        </h3>
                        <!-- Button zum Löschen der News -->
                        <?php if (isset($_COOKIE["admin"])) {
                            if ($row["newsOnline"] == 1) {
                                $newsOnline = "online"; ?>
                                <h4 class="text-info">News ist
                                    <?php echo $newsOnline ?>
                                </h4>
                                <form action="index.php?page=newsNtf&msg=newsOffline&newsId=<?php echo $row["newsId"] ?>" method="post">
                                    <input type="text" name="newsId" value="<?php echo $row["newsId"]; ?>">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-danger ms-auto">News offline stellen</button>
                                    </div>
                                </form>
                            <?php } else {
                                $newsOnline = "offline"; ?>
                                <h4 class="text-info">News ist
                                    <?php echo $newsOnline ?>
                                </h4>
                                <form action="index.php?page=newsNtf&msg=newsOnline&newsId=<?php echo $row["newsId"] ?>" method="post">
                                    <input type="text" name="newsId" value="<?php echo $row["newsId"]; ?>">
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-success ms-auto">News online stellen</button>
                                    </div>
                                </form>
                            <?php }
                            ?>
                        <?php } ?>
                    </div>
                    <?php
                }
}
?>
            </form>
        </div>
    </div>
</div>