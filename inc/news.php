    <div style="margin-bottom: 100px;">
        <h1>NEWS</h1>
        <div class="d-grid col-12 mx-auto">
            <div class="mb-3 container">
                <?php
                if(isset($_GET["upload"])) {
                    if($_GET["upload"] == "success") {
                        echo '<p class="text-success">News hochgeladen</p>';
                    }
                }
                ?>
                <?php
                require_once 'utils/dbaccess.php';
                $sql = "SELECT * FROM news ORDER BY newsdate DESC";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    ?>
                    <?php
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="text-center">
                            <h2>
                                <?php
                                echo $row["title"]."<br>";
                                ?>
                            </h2>
                        </div>
                        <div class="text-center mb-4">
                            <div class="container">
                                <?php
                                if(!empty($row["filePath"])) {
                                    echo '<img src="'.$row["filePath"].'" alt="Thumbnail" class="img-thumbnail img-fluid">';
                                }
                                ?>

                            </div>
                        </div>
                        <div class="alert alert-light" role="alert" data-bs-theme="dark">
                            <p style="text-align: justify;">
                                <?php
                                echo $row["text"]."<br>";
                                ?>
                            </p>
                            <h3>
                                <?php
                                $newsDate = date("d.m.Y H:i:s", strtotime($row["newsDate"]));
                                echo "News vom ".$newsDate."<br>";
                                ?>
                            </h3>
                        </div>
                        <?php
                    }
                } else {
                    echo '
                <h3>Keine News vorhanden!</h3>
                </div>';
                    header("Location: index.php?error=noNews");
                }
                ?>
            </div>
        </div>
    </div>