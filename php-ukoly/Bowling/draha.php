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
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bowling";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$datum = $_SESSION["datum"];
$cas = $_SESSION['cas'];
$draha = $_GET['draha'];

if($draha == 1 || $draha == 2 || $draha == 3 || $draha == 4){ 
    //UPDATE Users SET weight = 160, desiredWeight = 45 where id = 1;
    $sql = "UPDATE rezervace SET draha='$draha' WHERE datum='$datum' AND cas='$cas'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $_SESSION["datum"] = $datum;
        $_SESSION["cas"] = $cas;
        $_SESSION["draha"] = $draha;
        header("Location:jmeno.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}else{
    vyberDrahu();
}

function vyberDrahu(){
    echo '
    Vyberte si dráhu:
    <a href="draha.php?draha=1">1</a>
    <a href="draha.php?draha=2">2</a>
    <a href="draha.php?draha=3">3</a>
    <a href="draha.php?draha=4">4</a>
    ';
}

?>

</body>
</html>