<?php
header("Refresh: 5; url=index.php?page=news");
include 'inc/landing.php';
require_once 'dbaccess.php';
?>
<?php if (isset($_GET["msg"])) {
    if ($_GET["msg"] == "newsOnline") {
        $sql = "UPDATE news SET newsOnline = 1 WHERE newsId = " . $_GET["newsId"];
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
            <p>SQL-Fehler</p>
            <?php return;
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        ?>
        <div class="success">
            <div class="success__body">
                <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                News online gestellt!
            </div>
            <div class="success__progress"></div>
        </div>
        <?php
    } else if ($_GET["msg"] == "newsOffline") {
        $sql = "UPDATE news SET newsOnline = 0 WHERE newsId = " . $_GET["newsId"];
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
                <p>SQL-Fehler</p>
            <?php return;
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        ?>
            <div class="success">
                <div class="success__body">
                    <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                    News offline gestellt!
                </div>
                <div class="success__progress"></div>
            </div>
        <?php
    } else if ($_GET["msg"] == "uploadSuccess") {
        ?>
                <div class="success">
                    <div class="success__body">
                        <img src="res/img/check-circle.svg" alt="Success" class="success__icon">
                        News hochgeladen!
                    </div>
                    <div class="success__progress"></div>
                </div>
        <?php
    }
}
?>