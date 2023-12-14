<?php

if (isset($_POST["resetPassword"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $newPassword = $_POST["password"];
    $newPasswordRepeat = $_POST["passwordRepeat"];
    echo $newPassword;
    echo $newPasswordRepeat;

    if (empty($newPassword) || empty($newPasswordRepeat)) {
        header("Location: index.php?page=create-new-password.php&selector=" . $selector . "&validator=" . $validator . "&reset=empty");
        exit();
    } else if ($newPassword != $newPasswordRepeat) {
        header("Location: index.php?page=create-new-password.php&selector=" . $selector . "&validator=" . $validator . "&reset=pwdnotsame");
        exit();
    }

    $currentDate = date("U");

    require 'dbaccess.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.";
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } else if ($tokenCheck === true) {
                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM users WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Error";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    } else {
                        $sql = "UPDATE users SET password=? WHERE email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "Error";
                            exit();
                        } else {
                            echo $newPassword;
                            $newPwdHash = password_hash($newPassword, PASSWORD_DEFAULT);
                            echo $newPwdHash;
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "Error";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: index.php?page=login&newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: index.php");
}