<?php
$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "banka2";

$ok = $_POST['ok'];
$deposit = $_POST['deposit'];

session_start();
$id = $_SESSION['id'];

if(isset($ok)){
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, castka FROM klienti WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $stavUctu = $row["castka"];
        }
    } else {
        echo "0 výsledků";
    }

    $sql2 = "UPDATE klienti SET castka=castka+$deposit WHERE id='$id'";

    if ($conn->query($sql2) === TRUE) {
        echo "Vloženo " . $deposit . " korun";
        $_SESSION['castka'] = $stavUctu;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banka</title>
</head>
<body>
    <h1>Vklad</h1>
    <form action="vlozit.php" method="post">
        Kolik chcete vložit peněz?<input type="number" name="deposit"><br>
        <input type="submit" name="ok" value="Potvrdit"><br>
    </form>
    <a href="profil.php">Zpět</a>
    <a href="index.php?odhlasit=true">Odhlásit</a>
</body>
</html>