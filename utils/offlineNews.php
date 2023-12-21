<?php
require_once 'dbaccess.php';
$sql = "UPDATE news SET newsOnline = 0 WHERE newsId = " . $_POST["newsId"];
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
    <p>SQL-Fehler</p>
    <?php return;
}
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
header("Location: ../index.php?page=news&offlineNews=success");