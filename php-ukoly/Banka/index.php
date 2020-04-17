<?php
$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "banka2";

$odhlasit = $_GET['odhlasit'];
$ok = $_POST['ok'];
$jmeno = $_POST['jmeno'];
$prijmeni = $_POST['prijmeni'];
$email = $_POST['email'];
$heslo = $_POST['pass'];
$hesloKont = $_POST['passCheck'];
$prvniVklad = $_POST['money'];

if($odhlasit == true){
    session_unset();
    session_destroy();
}

if(isset($ok)){
    if($prvniklad <= 100) $prvniVklad = 100;

    if($heslo == $hesloKont){
        $hash = password_hash($heslo, PASSWORD_DEFAULT);

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql1 = "SELECT email FROM klienti WHERE email='$email'";
        $result = $conn->query($sql1);

        if ($result->num_rows != 0) {
            echo "Účet s emailem " . $email . " už existuje.";
        }else{
            $sql2 = "INSERT INTO klienti (jmeno, prijmeni, email, heslo, castka)
            VALUES ('$jmeno', '$prijmeni', '$email', '$hash', '$prvniVklad')";

            if ($conn->query($sql2) === TRUE) {
                echo "Účet byl úspěšně založený.";
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }

        $conn->close();

    }else{
        echo "Hesla se neshodují!";
    }
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
    <h1>Vytvořte si účet:</h1>
    <form action="index.php" method="post">
        Jméno: <input type="text" name="jmeno"><br>
        Příjmení: <input type="text" name="prijmeni"><br>
        Email: <input type="email" name="email" placeholder="example@gmail.com"><br>
        Heslo: <input type="password" name="pass" ><br>
        Heslo podruhé: <input type="password" name="passCheck"><br>
        Vklad: <input type="number" name="money"> - minimální vklad je 100Kč<br>
        <input type="submit" name="ok" value="Odeslat"><br>
    </form>
    <span>Máš už účet vytvořený? <a href="prihlas.php" class="loginButton">Přihlásit</a></span>
</body>
</html>