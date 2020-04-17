<?php 

$ok = $_POST['ok'];
$novaDiskuze = $_POST['new'];

$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "forum2";

session_start();
$jmeno = $_SESSION['jmeno'];

if(isset($ok)){

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Připojení selhalo: " . $conn->connect_error);
    }

    $sql = "INSERT INTO diskuze (uzivatel, diskuze, likes, dislikes)
            VALUES ('$jmeno', '$novaDiskuze', '0', '0')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class=\"echoMsg\">Nová diskuze byla úspěšně vytvořena.</div>";
    } else {
        echo "<div class=\"echoErr\">Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $conn->close();
}

$like = $_GET['like'];
$dislike = $_GET['dislike'];

if(isset($like)){

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE diskuze SET likes=likes+1 WHERE id=$like";

    if ($conn->query($sql) === TRUE) {
        echo "<div class=\"echoMsg\">Like přidán</div>";
    } else {
        echo "<div class=\"echoErr\">Error při přidávání liku: " . $conn->error . "</div>";
    }

    $conn->close();
}

if(isset($dislike)){

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE diskuze SET dislikes=dislikes+1 WHERE id=$dislike";

    if ($conn->query($sql) === TRUE) {
        echo "<div class=\"echoMsg\">Dislike přidán</div>";
    } else {
        echo "<div class=\"echoErr\">Error při přidávání disliku: " . $conn->error . "</div>";
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

        .echoMsg {
            margin: 25px;
            font-size: 20px;
        }

        .diskuze {
            background-color: #dde1e7;
            border-radius: 25px;
            margin: 35px auto;
            padding: 15px;
            width: 500px;
            box-shadow: -3px -3px 7px #ffffff73, 3px 3px 7px rgba(94, 104, 121, .288);
        }

        input {
            background-color: #f0f0f0;
            border: 2px solid #9c9c9c;
            color: black;
            border-radius: 6px;
            padding: 5px;
            margin: 5px;
        }

        a {
            text-decoration: none;
            background-color: #f0f0f0;
            border: 2px solid #9c9c9c;
            color: black;
            border-radius: 6px;
            margin: 5px;
            padding: 5px;
        }

        .like {
            transition: 0.5s;
        }

        .like:hover {
            background-color: green;
            color: white;
            border: 2px solid white;
        }

        .dislike {
            transition: 0.5s;
        }

        .dislike:hover {
            background-color: red;
            color: white;
            border: 2px solid white;
        }

        .komentarDiv {
            background-color: white;
            border: 1px solid #9c9c9c;
            margin: 5px;
            padding: 0.3px;
        }

        .uzivatel {
            border-right: 1px solid #9c9c9c;
            padding-right: 5px;
            font-weight: bold;
        }

        .komentar {
            color: #9c9c9c;
        }

    </style>
</head>
<body>
        <h1>Diskuzní fórum</h1>
<?php



echo "<div class=\"echoMsg\">Vítej " . $jmeno . "! <a href=\"index.php?logout=true\">Odhlásit</a></div>";

echo "

<form action=\"diskuze.php\" method=\"post\">
    <input type=\"text\" name=\"new\" placeholder=\"Zahejte novou diskuzi...\"><br>
    <input type=\"submit\" name=\"ok\" value=\"Odeslat\">
</form>

";

$ok2 = $_POST['commentOK'];
$id = $_GET['id'];
$koment = $_POST['comment'];

if(isset($ok2)){

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Připojení selhalo: " . $conn->connect_error);
    }

    $sql = "INSERT INTO komentare (uzivatel, komentar, diskuze_id)
            VALUES ('$jmeno', '$koment', '$id')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class=\"echoMsg\">Komentář byl úspěšně přidán.</div>";
    } else {
        echo "<div class=\"echoErr\">Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

    $conn->close();

}

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Připojení selhalo: " . $conn->connect_error);
}

$sql = "SELECT id, uzivatel, diskuze, likes, dislikes FROM diskuze";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
    // output data of each row
    while($row = $res->fetch_assoc()) {
        echo "
        <div class=\"diskuze\">
            <h3>" . $row["uzivatel"] . " ></h3>
            <p>" . $row["diskuze"]. "</p><br>
            <a href=\"diskuze.php?like=" . $row["id"] . "\" class=\"like\"> Like (" . $row["likes"] . " liků)</a>
            <a href=\"diskuze.php?dislike=" . $row["id"] . "\" class=\"dislike\"> Dislike (" . $row["dislikes"]. " disliků)</a><br><br>
            <form action=\"diskuze.php?id=" . $row["id"] . "\" method=\"post\">
                <input type=\"text\" name=\"comment\" placeholder=\"Přidejte komentář...\">
                <input type=\"submit\" name=\"commentOK\" value=\"Odeslat\">
            </form>
            <h3>Komentáře:</h3>        
        ";

        $diskuzeID = $row["id"];

            $sql2 = "SELECT uzivatel, komentar FROM komentare WHERE diskuze_id='$diskuzeID'";
            $res2 = $conn->query($sql2);

            if ($res2->num_rows > 0) {
                // output data of each row
                while($row2 = $res2->fetch_assoc()) {
                    echo "
                    <div class=\"komentarDiv\">
                        <span class=\"uzivatel\">" . $row2["uzivatel"]. "</span>
                        <span class=\"komentar\"> > " . $row2["komentar"]. "</span>
                    </div>";
                }
            } else {
                echo "<div class=\"echoMsg\">Žádný komentář</div>";
            }

        echo "</div>";

    }
    
} else {
    echo "<div class=\"echoMsg\">Žádná diskuze</div>";
}

$conn->close();

?>

</body>
</html>