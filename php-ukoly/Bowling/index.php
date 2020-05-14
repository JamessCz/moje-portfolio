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
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "bowling";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ok = $_POST['ok'];
$datum = $_POST['datum'];

if(isset($ok)){
    $sql = "INSERT INTO rezervace (datum) VALUES ('$datum')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $_SESSION["datum"] = $datum;
        header("Location:cas.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}else{
    vyberDatum();
}

function vyberDatum(){
    echo "
    <form action=\"index.php\" method=\"post\">
    Vyberte si datum: <input type=\"date\" name=\"datum\"><br>
    <input type=\"submit\" name=\"ok\" value=\"Odeslat\"><br>
    </form>";
}

?>

    
</body>
</html>