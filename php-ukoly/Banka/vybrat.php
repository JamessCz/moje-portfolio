<?php
$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "banka2";

$ok = $_POST['ok'];
$withdraw = $_POST['withdraw'];

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

    if($withdraw > $stavUctu){
        echo "Nedostatek peněz na účtu";
    }else{
        $conn2 = new mysqli($servername, $username, $password, $dbname);

        if ($conn2->connect_error) {
            die("Connection failed: " . $conn2->connect_error);
        }

        $sql2 = "UPDATE klienti SET castka=castka-$withdraw WHERE id='$id'";

        if ($conn2->query($sql2) === TRUE) {
            echo "Vybráno " . $withdraw . " korun";
            $_SESSION['castka'] = $stavUctu;
        } else {
            echo "Error updating record: " . $conn2->error;
        }
        
        $conn2->close();
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
    <h1>Výběř z účtu</h1>
    <form action="vybrat.php" method="post">
        Kolik chcete vybrat peněz?<input type="number" name="withdraw"><br>
        <input type="submit" name="ok" value="Potvrdit"><br>
    </form>
    <a href="profil.php">Zpět</a>
    <a href="index.php?odhlasit=true">Odhlásit</a>
</body>
</html>