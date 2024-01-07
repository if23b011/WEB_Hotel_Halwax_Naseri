<?php
header("Refresh: 1; url=index.php?page=news");
include "inc/news.php";
require_once "utils/dbaccess.php";
?>
<?php if (isset($_GET["msg"])) {
    if ($_GET["msg"] == "newsOnline") {
        $sql = "UPDATE news SET newsOnline = 1 WHERE newsId = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landingNtf&error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $_GET["newsId"]);
        mysqli_stmt_execute($stmt);
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
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: index.php?page=landingNtf&error=stmtFailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "i", $_GET["newsId"]);
        mysqli_stmt_execute($stmt);
        ?>
            <div class="warning">
                <div class="warning__body">
                    <img src="res/img/eye-off.svg" alt="Error" class="warning__icon">
                    News offline gestellt!
                </div>
                <div class="warning__progress"></div>
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