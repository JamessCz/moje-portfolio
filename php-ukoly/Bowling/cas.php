<?php
session_start();
?>

<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bowling - Rezervace</title>
</head>
<body>
    
<?php
//session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bowling";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ok = $_POST['ok'];
$datum = $_SESSION["datum"];
$cas = $_POST['cas'];

if(isset($ok)){ 
        $sql = "UPDATE rezervace SET cas='$cas' WHERE datum='$datum'";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            $_SESSION["datum"] = $datum;
            $_SESSION["cas"] = $cas;
            header("Location:draha.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
}else{
    vyberCas();
}

function vyberCas(){
    echo '
    <form action="cas.php" method="post">
    Vyberte si čas: <input type="time" name="cas"><br>
    <input type="submit" name="ok" value="Odeslat"><br>
    </form>';
}

?>

</body>
</html>