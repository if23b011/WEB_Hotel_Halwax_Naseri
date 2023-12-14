<div class="container" style="margin-bottom: 100px;">
    <h1>News uploaden</h1>
    <form method="post" action="utils/upload.php" enctype="multipart/form-data">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlText" class="form-label">
                            <p>Newstitel:</p>
                        </label>
                        <input class="form-control" type="text" name="title" id="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">
                            <p>Newstext:</p>
                        </label>
                        <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                    </div>
                    <div class="mb-3">
                        <p>Bild auswählen (optional):</p>
                        <p><input type="file" name="fileToUpload"></p>
                    </div>
                    <div class="d-grid gap-2">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>