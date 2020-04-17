<!DOCTYPE html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Sen&display=swap" rel="stylesheet">
    <title>Anketa</title>
    <style>
        body {
            font-family: 'Sen', sans-serif;
            text-align: center;
            color: white;
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
        }

        h1 {
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 2px;
            font-size: 50px;
        }

        .anketa {
            text-align: center;
            margin: auto;
            padding-top: 15px;
            padding-bottom: 15px;
            width: 500px;
            height: 575px;
            border-radius: 15px;
            background: rgb(0,159,255);
            background: radial-gradient(circle, rgba(0,159,255,1) 0%, rgba(173,173,205,1) 100%);
        }

        .anketa h2 {
            margin-bottom: 25px;
        }

        .anketa h3 {
            color: blue;
            padding: 6px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .anketa a {
            text-decoration: none;
            margin: 5px;
            padding: 10px;
            transition: 0.5s;
        }

        .anketa a:hover {
            color: white;
            border-top: 1.5px solid white;
            border-left: 1.5px solid white;
            border-radius: 8px;
            box-shadow: 2px 2px 1.6px 1px rgba(255,255,255,0.5);
            /*box-shadow: inset 2px 2px 1.6px 1px rgba(255,255,255,0.5);*/
        }

        #piechart {
            position: absolute;
            top: 565px;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: auto;
            text-align: center;
        }
        
        .selected {
            background-color: rgba(255,255,255,0.5);
        }
        
        #cokolada {
            border-bottom: 2px solid brown;
        }
        
        #vanilka {
            border-bottom: 2px solid lightyellow;
        }
        
        #jahoda {
            border-bottom: 2px solid red;
        }

    </style>
</head>
<body>
    <h1><a href="index.html">Anketa</a></h1>
    
<?php

$volba = $_GET['volba'];
$vyber;
$prichut;
$selected;
$cokolada;
$vanilka;
$jahoda;

if($volba == 1){
    $prichut = "<span id=\"cokolada\">čokoládovou</span>";
    $vyber = "UPDATE odpovedi SET cokolada=cokolada+1";
    $selected = "cokolada";
}else if($volba == 2){
    $prichut = "<span id=\"vanilka\">vanilkovou</span>";
    $vyber = "UPDATE odpovedi SET vanilka=vanilka+1";
    $selected = "vanilka";
}else {
    $prichut = "<span id=\"jahoda\">jahodovou</span>";
    $vyber = "UPDATE odpovedi SET jahoda=jahoda+1";
    $selected = "jahoda";
}

echo "<div class=\"anketa\"><h2>Vybral/a sis že máš nejradši " . $prichut . " příchuť zmrzliny</h2>";

$servername = "localhost";
$username = "jakubhoracek";
$password = "xwx48xwx";
$dbname = "anketa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $vyber;

if ($conn->query($sql) === TRUE) {
    echo "Záznam uložen";
} else {
    echo "Chyba při ukládání záznamu: " . $conn->error;
}

$sql2 = "SELECT cokolada, vanilka, jahoda FROM odpovedi";
$result = $conn->query($sql2);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cokolada = $row["cokolada"];
        $vanilka = $row["vanilka"];
        $jahoda = $row["jahoda"];
        if($selected == "cokolada"){
            echo "<h3 class=\"selected\">Počet lidí co si vybrali <span id=\"cokolada\">čokoládovou</span> příchuť: " . $cokolada . "</h3>";
            echo "<h3>Počet lidí co si vybrali <span id=\"vanilka\">vanilkovou</span> příchuť: " . $vanilka . "</h3>";
            echo "<h3>Počet lidí co si vybrali <span id=\"jahoda\">jahodovou</span> příchuť: " . $jahoda . "</h3>";
        }else if($selected == "vanilka"){
            echo "<h3>Počet lidí co si vybrali <span id=\"cokolada\">čokoládovou</span> příchuť: " . $cokolada . "</h3>";
            echo "<h3 class=\"selected\">Počet lidí co si vybrali <span id=\"vanilka\">vanilkovou</span> příchuť: " . $vanilka . "</h3>";
            echo "<h3>>Počet lidí co si vybrali <span id=\"jahoda\">jahodovou</span> příchuť: " . $jahoda . "</h3>";
        }else {
            echo "<h3>Počet lidí co si vybrali <span id=\"cokolada\">čokoládovou</span> příchuť: " . $cokolada . "</h3>";
            echo "<h3>Počet lidí co si vybrali <span id=\"vanilka\">vanilkovou</span> příchuť: " . $vanilka . "</h3>";
            echo "<h3 class=\"selected\">Počet lidí co si vybrali <span id=\"jahoda\">jahodovou</span> příchuť: " . $jahoda . "</h3>";
        }
        
        echo "<div id=\"piechart\"></div>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var cokolada = <?php echo $cokolada ?>;
var vanilka = <?php echo $vanilka ?>;
var jahoda = <?php echo $jahoda ?>;

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Příchuť', 'Počet hlasů'],
  ['Čokoláda', cokolada],
  ['Vanilka', vanilka],
  ['Jahoda', jahoda],
]);

  // Optional; add a title and set the width and height of the chart
  var options = {
      'title':'Graf', 
      'slices': [{color: 'brown'}, {color: 'lightyellow'}, {color: 'red'}],
      'pieSliceTextStyle': { color: 'black' },
      'width':450, 
      'height':300,
      'is3D': true,
      'legend': 'none',
      'pieSliceText': 'label'
      };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

</body>
</html>