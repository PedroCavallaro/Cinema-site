<?php
    include_once "../src/tiType.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                <label>Total: </label>
                <label id="totalValue"></label>
            </div>
        </div>
        <div class="snackBar">
            <div>
                <h1>Bomboniere</h1>
            </div>
            <?=getSnacks()?>
        </div>

    </div>
        </main>
        <script src="dist/ticketType.js"></script>
    </body>
    </html>
