<?php

$ok = $_POST['ok'];
$jmeno = $_POST['jmeno'];
$pass = $_POST['pass'];
$passCheck = $_POST['passCheck'];

$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "forum2";

if(isset($ok)){
    if($pass == $passCheck){

        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Připojení selhalo: " . $conn->connect_error);
        }

        $sql1 = "SELECT * FROM uzivatele WHERE nickname='$jmeno'";
        $res1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($res1) > 0) {
            echo "<div class=\"echoMsg\">Je mi to líto, ale nickname " . $jmeno . " už někdo používá, vyber si jiný.</div>"; 	
        }else{
            $sql = "INSERT INTO uzivatele (nickname, heslo)
                VALUES ('$jmeno', '$hash')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class=\"echoMsg\">Váš účet byl úspěšně vytvořen, nyní se mužete <a href=\"prihlas.php\" class=\"loginA\">přihlásit</a></div>";
            } else {
                echo "<div class=\"echoErr\">Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        $conn->close();

    }else{
        echo "<div class=\"echoMsg\">Vaše hesla se neshodují</div>";
    }
}

$logout = $_GET['logout'];

if($logout == true){
    unset($_SESSION['user']);
    $logout = false;
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
        <h1>Vytvořte si účet:</h1>
        <form action="index.php" method="post">
            <input type="text" name="jmeno" placeholder="Uživatelské jméno: "><br>
            <input type="password" name="pass" placeholder="Heslo: "><br>
            <input type="password" name="passCheck" placeholder="Heslo podruhé: "><br>
            <input type="submit" name="ok" value="Odeslat"><br>
        </form>
        <span>Máš už účet vytvořený? <a href="prihlas.php" class="loginButton">Přihlásit</a></span>
    </div>
</body>
</html>