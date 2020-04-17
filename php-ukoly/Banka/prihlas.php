<?php
$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "banka2";

$ok = $_POST['ok'];
$email = $_POST['email'];
$heslo = $_POST['pass'];

if(isset($ok)){
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, jmeno, prijmeni, email, heslo, castka FROM klienti WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $db_id = $row["id"];
            $db_jmeno = $row["jmeno"];
            $db_prijmeni = $row["prijmeni"];
            $db_email = $row["email"];
            $db_heslo = $row["heslo"];
            $db_money = $row["castka"];
        }
    } else {
        echo "0 výsledků";
    }

    $passIsValid = password_verify($heslo, $db_heslo);

    if ($passIsValid) {
        session_start();
        $_SESSION['id'] = $db_id;
        $_SESSION['jmeno'] = $db_jmeno;
        $_SESSION['prijmeni'] = $db_prijmeni;
        $_SESSION['email'] = $db_email;
        $_SESSION['castka'] = $db_money;
        header('Location: profil.php');
    }else{
        echo "Špatné heslo";
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
    <h1>Přihlašte se:</h1>
    <form action="prihlas.php" method="post">
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="pass" placeholder="Heslo"><br>
        <input type="submit" name="ok" value="Odeslat"><br>
    </form>
    <span>Nemáš vytvořený účet? <a href="prihlas.php" class="loginButton">Vytvořit</a></span>
</body>
</html>