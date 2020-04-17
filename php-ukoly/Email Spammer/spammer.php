<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Spammer</title>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
    <style>

        body {
            background: rgb(89,14,204);
            background: radial-gradient(circle, rgba(89,14,204,1) 0%, rgba(39,4,130,1) 100%);
            color: white;
            text-align: center;
            font-family: 'Varela Round', sans-serif;
        }

        form {
            text-align: left;
            margin-left: 25%;
        }

        #pass_input {
            font-size: 18px;
        }

        #submit_btn {
            background-image: linear-gradient(to right, #FF512F 0%, #F09819 51%, #FF512F 100%);
            margin-top: 35px;
            padding: 15px;
            text-align: right;
            margin-left: 60%;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
        }

        #submit_btn:hover {
            background-position: right center;
        }

        h1 {
            font-size: 55px;
        }

        h2 {
            font-size: 30px;
        }

        #message {
            text-align: left;
            margin-right: 25px;
            margin-top: 50px;
        }

        .formItems {
            text-align: left;
            margin-right: 25px;
            margin-top: 50px;
        }


    </style>
</head>
<body>

<div class="content">

    <h2>Send your Email</h2>

    <form action="spammer.php" method="post" id="usrform">
        From: <input type="email" name="from" size="35" placeholder="somebody@gmail.com" id="from" class="formItems"><br>
        To: <input type="email" name="to" size="35" placeholder="someone@gmail.com" id="to" class="formItems"><br>
        Title: <input type="text" name="title" size="35" placeholder="Important Message" id="title" class="formItems"><br>
        <textarea name="message" form="usrform" id="message" rows="4" cols="50">
        Enter text here...
        </textarea><br>
        <input type="submit" value="Send" id="submit_btn">
    </form>

</div>

<?php

$from = $_POST['from'];
$to = $_POST['to'];
$title = $_POST['title'];
$mess = $_POST['message'];

function odeslatEmail($adresa, $predmet, $odesilatel, $zprava){

    $text = mb_strtoupper($zprava);
    $kdo = 'From: ' . $odesilatel;
    //for($i = 0; $i < 100; $i++);
    $odeslano = mb_send_mail($adresa, $predmet, $text, $kdo);

    return $odeslano;

}

$odeslano = odeslatEmail($to, $title, $from, $mess);

if($odeslano){
    echo "Email was sent.";
}else{
    echo "Error";
}

?>

</body>
</html>

