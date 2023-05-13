<?php
    include_once "../src/tiType.php";
    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
    date_default_timezone_set('Europe/Lisbon');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/ticketType.css">
    <title>Tipo Ingresso</title>
</head>
<body>
    <header>
        <div>
            <a id="homeBAnchor"href="index.php">
                <img id="homeButton" src="img/homeImg.png">
            </a>
        </div>
    </header>
    <main>
    <div class="asideInfo">
        <img src="" class="moviePoster">
        <h1 id="movieName" class="info"></h1>
        <h2 id="movieDuration" class="info"></h2>
        <h2  class="txtInfo" >Duração:</h2>
        <h2 id="movieGender" class="info"></h2>
        <h2  class="txtInfo">Gênero</h2>
        <h2 id="movieRoom" class="info"></h2>
        <h2 class="txtInfo" >Sala:</h2>   
        <h2 id="movieTime" class="info"></h2>
        <h2  class="txtInfo">Horário: </h2>
        <h2 id="movieTime" class="info"></h2>
    </div>
    <div class="ticketTypeChoice">
        <div>
            <h2 id="seats">Assentos: </h2><br>
            <?=getTicketInfo()?>
            <div class="amount">
                <label>Total: R$ </label>
                <label id="totalValue"></label>
            </div>
        </div>
        <div class="snackBar">
            <div>
                <h1>Bomboniere</h1>
            </div>
            <?=getSnacks()?>
            <a class="goToPayment" href="payment.php">
                <input type="button" value="Continuar">
            </a>
        </div>
           
        </div>
        </main>

        <script src="dist/ticketType.js"></script>
    </body>
    </html>
