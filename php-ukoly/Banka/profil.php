<?php
session_start();
$db_jmeno = $_SESSION['jmeno'];
$db_id = $_SESSION['id'];
$_SESSION['id2'] = $id;

echo "Vítej " . $db_jmeno;

$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "banka2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, castka FROM klienti WHERE id='$db_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stavUctu = $row["castka"];
    }
} else {
    echo "0 výsledků";
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
    <h1>Informace o účtu: </h1>
    <?php
        session_start();
        $db_id = $_SESSION['id'];
        $db_jmeno = $_SESSION['jmeno'];
        $db_prijmeni = $_SESSION['prijmeni'];
        $db_email = $_SESSION['email'];
        //$db_money = $_SESSION['castka'];

        $koncovkaBanky = "/1234";
        $cisloUctu = $db_id . $koncovkaBanky;

        echo "Číslo účtu: " . $cisloUctu . "<br>";
        echo "Jméno: " . $db_jmeno . "<br>";
        echo "Příjmení: " . $db_prijmeni . "<br>";
        echo "Email: " . $db_email . "<br>";
        echo "Částka na účtu: " . $stavUctu . "<br>";

        //session_unset();
    ?>
    <a href="vybrat.php">Vybrat</a><a href="vlozit.php">Vložit</a>
    <a href="index.php?odhlasit=true">Odhlásit</a>
</body>
</html>