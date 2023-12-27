<?php
require_once 'utils/functions.php';
//? allgemeine Funktionen
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//? Funktionen für Login und Registrierung
function emailExists($conn, $email)
{
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
            $userData = emailExists($conn, $email);
            if ($userData) {
                //?  Verify the password
                if (password_verify($password, $userData['password'])) {
                    //?  Password is correct
                    $_SESSION['login'] = true;
                    //FIXME Cookie ist nicht sicher
                    setcookie("email", $_POST["email"], time() + (86400 * 30), "/");
                    //? Datenbankabfrage
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if ($row['type'] == 'admin') {
                        $_SESSION['admin'] = true;
                        setcookie("admin", true, time() + (86400 * 30), "/");
                        header("Location: index.php?page=landingNtf&error=noneLogin");
                    } else {
                        header("Location: index.php?page=landingNtf&error=noneLogin");
                    }
                } else {
                    header("Location: index.php?page=loginNtf&error=wrongPassword"); ?>
                <?php }
            } else {
                //? User does not exist
                header("Location: index.php?page=loginNtf&error=wrongEmail"); ?>
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