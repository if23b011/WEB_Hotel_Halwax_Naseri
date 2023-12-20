<?php
//? allgemeine Funktionen
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//? Funktionen für Login und Registrierung
function loginEmailExists($conn, $email)
{
    require_once 'utils/dbaccess.php';
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
        <p>SQL-Fehler</p>
        <?php return;
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

function registerEmailExists($conn, $email)
{
    require_once 'utils/dbaccess.php';
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
        <p>SQL-Fehler</p>
    <?php }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}
function loginUser($conn, $email, $password)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = input($_POST["email"]);
        $password = input($_POST["password"]);

        //?  Validate the email and password
        if (!empty($email) && !empty($password)) {
            //?  Check if the user exists in the database
            $userData = loginEmailExists($conn, $email);

            if ($userData) {
                //?  Verify the password
                if (password_verify($password, $userData['password'])) {
                    //?  Password is correct
                    $_SESSION['login'] = true;
                    setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
                    //? Datenbankabfrage
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if ($row['type'] == 'admin') {
                        $_SESSION['admin'] = true;
                        setcookie("admin", true, time() + (86400 * 30), "/");
                        header("Location: index.php");
                    } else {
                        header("Location: index.php");
                    }
                } else { ?>
                    <p style="color: red;">Falsches Passwort!</p>
                <?php }
            } else { ?>
                //? User does not exist
                <p style="color: red;">Benutzer existiert nicht!</p>
            <?php }
        }
    }
}

//? Funktionen für Reservierung
function calculateCost($room, $arrivalDate, $departureDate, $breakfast, $parking, $pets)
{
    $totalCost = 0;
    $days = (strtotime($departureDate) - strtotime($arrivalDate)) / (60 * 60 * 24);
    if ($room == "Einzelzimmer mit Einzelbett") {
        $totalCost = $days * 30;
    } else if ($room == "Einzelzimmer mit Doppelbett") {
        $totalCost = $days * 75;
    } else if ($room == "Luxus Zimmer mit Jacuzzi") {
        $totalCost = $days * 200;
    } else if ($room == "Luxus Suite mit privatem Butler") {
        $totalCost = $days * 500;
    }
    if ($breakfast == "inkludiert") {
        $totalCost += $days * 5;
    }
    if ($parking == "inkludiert") {
        $totalCost += $days * 10;
    }
    if ($pets == "inkludiert") {
        $totalCost += 15;
    }
    return $totalCost;
}
function createReservation($conn, $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId)
{
    require_once 'utils/dbaccess.php';
    $sql = "INSERT INTO reservations (room, arrivalDate, departureDate, breakfast, parking, pets, comments, reservationDate, totalCost, status, FK_userId) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
        <p>SQL statement failed</p>
        <?php return;
    }

    mysqli_stmt_bind_param($stmt, "sssiiissdsi", $room, $arrivalDate, $departureDate, $breakfast, $parking, $pets, $comments, $reservationDate, $totalCost, $status, $FK_userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

//? Funktionen für Newsupload
function upload($conn, $title, $text, $target_file, $newsDate, $FK_userId)
{
    require_once '../utils/dbaccess.php';
    $newsDate = date("Y-m-d H:i:s");
    $sql = "INSERT INTO news (title, text, filepath, newsDate, FK_userId) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) { ?>
        <p>SQL statement failed</p>
        <?php return;
    }
    $target_file_db = substr($target_file, 3);
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $text, $target_file_db, $newsDate, $FK_userId);
    mysqli_stmt_execute($stmt);
    header("Location: ../index.php?page=news&upload=success");
}