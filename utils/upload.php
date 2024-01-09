<?php
require_once "../utils/dbaccess.php";
$newsDate = date("d.m.Y", time());
$time = time();
$newsDate = date("Y-m-d H:i:s", strtotime($newsDate));
$sql = "SELECT userId FROM users WHERE email = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?page=landing&error=stmtFailed");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $_COOKIE["email"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$target_file = null;
if ($row) {
    $FK_userId = $row["userId"];
    if (!empty($_FILES["fileToUpload"]["name"])) {
        $target_dir = "../uploads/news/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        //? Check if image file is a actual image or fake image
        if (isset($_FILES["fileToUpload"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else { ?>
                <p>File is not an image.</p>
                <?php $uploadOk = 0;
            }
        }
        //? Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) { ?>
            <p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>
            <?php $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //? Load the image
                $source_image = null;
                if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
                    $source_image = imagecreatefromjpeg($target_file);
                } else if ($imageFileType == "png") {
                    $source_image = imagecreatefrompng($target_file);
                } else if ($imageFileType == "gif") {
                    $source_image = imagecreatefromgif($target_file);
                }

                //? Check if image was successfully loaded
                if ($source_image) {
                    //? Get the original image dimensions
                    $orig_width = imagesx($source_image);
                    $orig_height = imagesy($source_image);

                    //? Calculate the new dimensions
                    $max_size = 720; //? Set the maximum size here
                    $ratio = $max_size / max($orig_width, $orig_height);
                    $new_width = $orig_width * $ratio;
                    $new_height = $orig_height * $ratio;

                    //? Create a new image with the new dimensions
                    $new_image = imagecreatetruecolor($new_width, $new_height);

                    //? Copy and resize the old image into the new image
                    imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

                    //? Save the new image over the old one
                    if ($imageFileType == "jpg" || $imageFileType == "jpeg") {
                        imagejpeg($new_image, $target_file);
                    } else if ($imageFileType == "png") {
                        imagepng($new_image, $target_file);
                    } else if ($imageFileType == "gif") {
                        imagegif($new_image, $target_file);
                    }

                    //? Free up memory
                    imagedestroy($source_image);
                    imagedestroy($new_image);
                }
                upload($conn, $_POST["title"], $_POST["text"], $target_file, $newsDate, $FK_userId);
            } else { ?>
                <p>Sorry, there was an error uploading your file.</p>
                <?php echo "Error: " . $_FILES["fileToUpload"]["error"];
            }
        } else { ?>
            <p>Sorry, your file was not uploaded.</p>
        <?php }
    } else {
        upload($conn, $_POST["title"], $_POST["text"], NULL, $newsDate, $FK_userId);
    }
} else { ?>
    <p>User not found or other error occurred.</p>
<?php }
//? Funktion für Newsupload
function upload($conn, $title, $text, $target_file, $newsDate, $FK_userId)
{
    $newsDate = date("Y-m-d H:i:s");
    $sql = "INSERT INTO news (title, text, filepath, newsDate, FK_userId) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: index.php?page=landing&error=stmtFailed");
        exit();
    }
    $target_file_db = substr($target_file, 3);
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $text, $target_file_db, $newsDate, $FK_userId);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?page=news&msg=uploadSuccess");
} ?>