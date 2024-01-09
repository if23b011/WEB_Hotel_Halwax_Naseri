<?php
if (!isset($_COOKIE["admin"])) {
    header("Location: index.php?page=landing&error=noAccess");
    exit();
}
?>
<div class="container" style="margin-bottom: 100px;">
    <div class="login-box d-flex justify-content-center align-items-center"
        style="height: auto; width: 100%; max-width: 42rem;">
        <div style="text-align: center;">
            <h1>News uploaden</h1>
            <form method="post" action="utils/upload.php" enctype="multipart/form-data">
                <div class="user-box">
                    <input type="text" name="title" id="title">
                    <label>Newstitel:</label>
                </div>
                <div class="user-box mb-3">
                    <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                    <label>Newstext:</label>
                </div>
                <div class="user-box mb-3">
                    <label>Bild auswählen (optional):</label>
                </div>
                <p><input type="file" name="fileToUpload"></p>
                <input type="submit" value="Upload" class="loginBoxSubmit">
            </form>
        </div>
    </div>
</div>