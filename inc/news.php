<div style="margin-bottom: 100px;">
    <h1>NEWS</h1>
    <div class="d-grid col-12 mx-auto">
        <div class="mb-3 container">
            <?php
            if (isset($_GET["upload"])) {
                if ($_GET["upload"] == "success") { ?>
                    <p class="text-success">News hochgeladen</p>
                    <?php
                    header("Refresh: 2; url=index.php?page=news");
                }
            }
            if (isset($_GET["deleteNews"])) {
                if ($_GET["deleteNews"] == "success") { ?>
                    <p class="text-success">News gelöscht</p>
                    <?php
                    header("Refresh: 2; url=index.php?page=news");
                }
            }
            ?>
            <?php
            require_once 'utils/dbaccess.php';
            $sql = "SELECT * FROM news where newsOnline = 1 ORDER BY newsDate DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                ?>
                <?php
                while ($row = $result->fetch_assoc()) {
                    if ($row["newsOnline"] == 1) {
                        ?>
                        <div class="text-center">
                            <h2>
                                <?php
                                echo $row["title"] . "<br>";
                                ?>
                            </h2>
                        </div>
                        <div class="text-center mb-4">
                            <div class="container">
                                <?php
                                if (!empty($row["filePath"])) {
                                    echo '<img src="' . $row["filePath"] . '" alt="Thumbnail" class="img-thumbnail img-fluid">';
                                }
                                ?>
                            </div>
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
                        </div>
                        <!-- Button zum Löschen der News -->
                        <div class="text-center">
                            <form action="utils/deleteNews.php" method="post">
                                <input type="hidden" name="newsId" value="<?php echo $row["newsId"]; ?>">
                                <button type="submit" class="btn btn-danger">News löschen</button>
                            </form>
                        </div>
                    <?php
                    }
                }
            } else { ?>
                <h3>Keine News vorhanden!</h3>
            </div>
            <?php header("Location: index.php?page=landing&error=noNews");
            }
            ?>
    </div>
</div>
</div>