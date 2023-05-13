<?php
include_once "../src/payment.php";
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set('Europe/Lisbon');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/payment.css">
    <title>Pagamento</title>
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
            <div>
                <img src="" class="moviePoster" class="info">
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
                <h2 class="txtInfo">Assentos</h2>
                <h2 class="info"></h2>
            </div>
        </div>
        <div class="itens-container"> 
            <div class="itens">
                <h2>Itens: </h2> 
                <table>
                    <tbody class="itensList">

                    </tbody>
                </table>
            </div>
            <div class="paymentMethod-container">
                <div class="paymentMethod">
                    <h2>Método de Pagamento</h2>
                    <div class="methods">
                        <?=paymentMethods()?>
                    </div>
                </div>
            </div>
            <div class="end">
                <div class="endButton">
                    <input type="button" value="Finalizar"> 
                    <div>
                        <p>R$</p>
                        <p id="finalValue"></p>
                    </div>
                </div>
            </div>
        </div>
        <div>

        </div>
    </main>
    <script type="module" src="dist/payment.js"></script>
</body>
</html>