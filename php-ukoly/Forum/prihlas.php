<?php

$ok = $_POST['ok'];
$jmeno = $_POST['jmeno'];
$pass = $_POST['pass'];

$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "forum2";

if(isset($ok)){

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Připojení selhalo: " . $conn->connect_error);
        }

        $sql = "SELECT nickname, heslo FROM uzivatele WHERE nickname='$jmeno'";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            // output data of each row
            while($row = $res->fetch_assoc()) {
                //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                $db_pass = $row["heslo"];
            }
        } else {
            echo "<div class=\"echoMsg\">Účet " . $jmeno . " neexistuje.</div>";
        }

        $passIsValid = password_verify($pass, $db_pass);

        if($passIsValid){
            session_start();
            $_SESSION['jmeno'] = $jmeno;
            header("Location: diskuze.php");
            //header('Location: diskuze.php?jmeno='.$jmeno);
        }else{
            echo "<div class=\"echoMsg\">Špatné heslo!</div>";
        }

        $conn->close();

}

?>
<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Sen&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Sen', sans-serif;
            margin: auto;
            text-align: center;
            background: rgb(221,225,231);
            background: radial-gradient(circle, rgba(221,225,231,1) 45%, rgba(190,230,255,1) 100%);
        }

        .tab {
            background-color: #dde1e7;
            border-radius: 25px;
            margin: 35px auto;
            padding: 15px;
            width: 500px;
            box-shadow: -3px -3px 7px #ffffff73, 3px 3px 7px rgba(94, 104, 121, .288);
        }

        h1 {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            font-size: 50px;
            margin-bottom: 15px;
            color: white;
            -webkit-text-stroke: 0.1px black;
        }

        form {
            margin: 25px;
            margin-bottom: 45px;
        }

        input {
            border-radius: 3px;
            padding: 6px;
            background-color: #f0f0f0;
            border: 2px solid #9c9c9c;
            border-radius: 3px;
            padding: 6px;
            color: black;
            margin: 2px;
        }

        .echoMsg {
            margin: 25px;
            font-size: 20px;
        }

        .echoErr {
            margin: 25px;
            font-size: 20px;
            color: red;
        }

        .loginA {
            text-decoration: none;
            color: blue;
            transition: 0.5s;
        }

        .loginA:hover {
            text-decoration: underline;
        }

        .loginA:active {
            text-decoration: underline;
            color: white;
        }

        .loginButton {
            margin-left: 5px;
            text-decoration: none;
            background-color: #f0f0f0;
            border: 2px solid #9c9c9c;
            border-radius: 3px;
            padding: 6px;
            color: black;
        }

    </style>
</head>
<body>
    <div class="tab">
        <h1>Přihlašte se:</h1>
        <form action="prihlas.php" method="post">
            <input type="text" name="jmeno" placeholder="Uživatelské jméno: "><br>
            <input type="password" name="pass" placeholder="Heslo: "><br>
            <input type="submit" name="ok" value="Odeslat"><br>
        </form>
        <span>Nemáte vytvořený účet? <a href="index.php" class="loginButton">Vytvořit</a></span>
    </div>
</body>
</html>