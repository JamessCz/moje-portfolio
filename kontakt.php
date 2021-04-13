<!DOCTYPE html>
<html lang="cz">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="theme-color" content="#aa1b14" />
  <!--rgb(170,27,20)-->
  <meta http-equiv="Cache-control" content="no-cache " />

  <!--SEO-->
  <meta name="description" content="Osobní portfolio Jakuba Horáčka" />
  <meta name="keywords" content="Jakub,Horáček,Gamer,Bubeník,Vývojář,Programátor,HTML,CSS,Java,JavaScript,C++,PHP,C#" />
  <meta name="author" content="Jakub Horáček" />
  <!--Open Graph Tags-->
  <meta property="og:title" content="Jakub Horáček" />
  <meta property="og:site_name" content="jakubhoracek.8u.cz" />
  <meta property="og:description" content="Osobní portfolio Jakuba Horáčka" />
  <meta property="og:type" content="portfolio" />
  <meta property="og:image" content="images/nahled.png" />
  <meta property="og:image:type" content="image/png" />
  <meta property="og:image:alt" content="Jakub Horáček" />
  <meta property="og:url" content="http://jakubhoracek.8u.cz/" />
  <!--Twitter Card-->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@Jakub__Horacek" />
  <meta name="twitter:title" content="Jakub Horáček" />
  <meta name="twitter:description" content="Moje osobní portfolio." />
  <meta name="twitter:image" content="images/nahled.png" />
  <!--Canonical Tag-->
  <link rel="canonical" href="http://jakubhoracek.8u.cz" />

  <title>Jakub Horáček</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="scrolldown.css" />
</head>

<body>
  <!--Scroll to top-->
  <button onclick="topFunction()" id="scrollUp">
    <i class="material-icons">forward</i>
  </button>

  <nav id="normalNav">
    <a href="index.html">Domů</a>
    <a href="tvorba.html">Portfolio</a>
    <a href="kontakt.php" id="activePage">Kontakt</a>
  </nav>

  <div id="mobileTitle"><h1>Kontakt</h1></div>

  <nav id="mobileNav">
    <a href="index.html"><i class="material-icons">home</i></a>
    <a href="tvorba.html"><i class="material-icons">view_carousel</i></a>
    <a href="kontakt.php" id="activePage"><i class="material-icons">phone</i></a>
  </nav>

  <br />
  <br />

  <div class="subSection">
    <h1>Sociální sítě</h1>
  </div>
  <div class="Social-Background">
    <div class="fb"></div>
    <div class="twtr"></div>
    <div class="ig"></div>
    <div class="pin"></div>
  </div>
  <div class="Container-Social">
    <ul>
      <li>
        <a href="https://www.facebook.com/Jamesshoracek/" target="_blank" data-classtochange="fb">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span class="fa fa-facebook" aria-hidden="true"></span>
        </a>
      </li>
      <li>
        <a href="https://twitter.com/Jakub__Horacek" target="_blank" data-classtochange="twtr">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span class="fa fa-twitter" aria-hidden="true"></span>
        </a>
      </li>
      <li>
        <a href="https://www.instagram.com/jamess_horacek/" target="_blank" data-classtochange="ig">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span class="fa fa-instagram" aria-hidden="true"></span>
        </a>
      </li>
      <li>
        <a href="https://cz.pinterest.com/horacekjak/" target="_blank" data-classtochange="pin">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span class="fa fa-pinterest" aria-hidden="true"></span>
        </a>
      </li>
    </ul>
  </div>


  <div class="subSection">
    <h1>Email</h1>
  </div>
  <div class="sect sectZaliby">
    <div class="Container">
      <p>
        <br>
        <h3 class="emailH3">Napiš mi email:</h3>
        <form action="kontakt.php" method="post" id="usrform" required>
          Tvoje emailová adresa: <br>
          <input type="email" name="from" size="35" placeholder="nekdo@gmail.com" id="from" class="formItems" required><br>
          Vlož nadpis svého emailu: <br>
          <input type="text" name="title" size="35" placeholder="Název" id="title" class="formItems" required><br><br>
          Zde napiš svoji zprávu: <br><textarea name="message" form="usrform" id="message" rows=”6″ cols=”20″ placeholder="Zpráva" required></textarea><br><br>
          <input type="submit" name="ok" value="Odeslat" id="submit_btn" class="subSectBtn"><br><br>
        </form>
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "portfolio";

        $date = date("Y/m/d");
        $from = $_POST['from'];
        $to = "horacek2001@seznam.cz";
        $title = $_POST['title'];
        $mess = $_POST['message'];
        $ok = $_POST['ok'];

        function odeslatEmail($adresa, $predmet, $odesilatel, $zprava)
        {

          $text = mb_strtoupper($zprava);
          $kdo = 'From: ' . $odesilatel;
          $odeslano = mb_send_mail($adresa, $predmet, $text, $kdo);

          return $odeslano;
        }

        function zapsatDoDB($servername, $username, $password, $dbname, $date, $from, $title, $mess){
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "INSERT INTO emaily (datum, odesilatel, nadpis, zprava) VALUES ('$date', '$from', '$title', '$mess')";

          if ($conn->query($sql) === TRUE) {
            //zapsáno
          } else {
            echo "Error: " . $sql . " " . $conn->error;
          }
          
          $conn->close();

          return $zapsano;
        }

        $odeslano = odeslatEmail($to, $title, $from, $mess);
        if(isset($ok)){
          $zapsano = zapsatDoDB($servername, $username, $password, $dbname, $date, $from, $title, $mess);
          if ($odeslano && $zapsano) {
            echo "Email byl úspěšně odeslán.";
          } else {
            echo "Error";
          }
        }

        ?>
      </p>
      <img src="" class="" alt="" />
    </div>
  </div>

  <footer>
    <h3>&copy;2020 Jakub Horáček</h3>
  </footer>

  <script src="scripts/scroll_up.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TimelineMax.min.js" integrity="sha256-fIkQKQryItPqpaWZbtwG25Jp2p5ujqo/NwJrfqAB+Qk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js" integrity="sha256-lPE3wjN2a7ABWHbGz7+MKBJaykyzqCbU96BJWjio86U=" crossorigin="anonymous"></script>
  <script src="scripts/textChanger.js" defer></script>
  <script defer>
    let tlacitka = document.querySelectorAll(".Container-Social a");

    tlacitka.forEach((e) => {
      e.addEventListener("mouseenter", () => {
        let string =
          ".Social-Background div." + e.getAttribute("data-classtochange");
        let div = document.querySelector(string);
        console.log(string);
        div.style.filter = "blur(0)";
      });
      e.addEventListener("mouseleave", () => {
        let string =
          ".Social-Background div." + e.getAttribute("data-classtochange");
        let div = document.querySelector(string);
        console.log(string);
        div.style.filter = "blur(5px)";
      });
    });
  </script>
</body>

</html>