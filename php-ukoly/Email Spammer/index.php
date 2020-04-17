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

        .content {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #pass_input {
            font-size: 18px;
        }

        #submit_btn {
            background-image: linear-gradient(to right, #FF512F 0%, #F09819 51%, #FF512F 100%);
            margin: 10px;
            padding: 15px;
            text-align: center;
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

    </style>
</head>
<body>

<?php

$password = $_POST['pass'];

if ($password =='iwannaprank')
{
    header("Location: spammer.php");
}
else
{
    echo 'you are not the admin';
}

//https://pepipost.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/

?>

<div class="content">

    <h1>Welcome to Email Spammer</h1>
    <h2>Enter correct password to gain access</h2>

    <form action="index.php" method="post">
        <input type="password" name="pass" id="pass_input">
        <input type="submit" value="Submit" id="submit_btn" >
    </form>

</div>

</body>
</html>