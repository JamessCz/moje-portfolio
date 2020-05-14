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
$cas = $_SESSION['cas'];
$draha = $_SESSION["draha"];
$jmeno = $_POST['jmeno'];

if(isset($ok)){ 
        $sql = "UPDATE rezervace SET jmeno='$jmeno' WHERE datum='$datum' AND cas='$cas' AND draha='$draha'";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            vypisRezervaci($servername, $username, $password, $dbname, $jmeno);
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
}else{
    vyberCas();
}

function vyberCas(){
    echo '
    <form action="jmeno.php" method="post">
    Na jaké jméno chcete provést rezervaci? <input type="text" name="jmeno"><br>
    <input type="submit" name="ok" value="Odeslat"><br>
    </form>';
}

function vypisRezervaci($servername, $username, $password, $dbname, $jmeno){
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT datum, cas, draha, jmeno FROM rezervace WHERE jmeno='$jmeno'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "
          <br><br>" . "
          Datum: " . $row["datum"]. "<br>" . "
          Čas: " . $row["cas"]. "<br> " . "
          Dráha: " . $row["draha"]. "<br>" . "
          Jméno: " . $row["jmeno"]. "<br>" . "
          <br><br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
}

?>

</body>
</html>