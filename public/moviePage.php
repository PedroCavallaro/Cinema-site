<!DOCTYPE html>
<?php

include_once "../src/moPage.php";
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set('Europe/Lisbon');
$movieId = $_COOKIE["movieId"];
session_start();
if(!$_SESSION["logged"]){
    header("location:./loginPage.php");
}
?>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="style/moviePage.css">
    <title>Horarios</title>
</head>
<body>
    <div class="seatsMainContainer">
        <div class="seatsContainer">
            <div class="seatsChoseContainer">
                <div class="movieInfo">
                    <div>
                        <img id="moviePoster">
                        <div class="movieContentModal">
                            <input id="closeModal" type="button" value="X">
                            
                            <?php
                            
                               echo movieInfoSeatsChoice()
                            ?>
                                <p id="ticketAmount">Assentos:</p>
                            
                            <!-- <p id="movieName">asd</p>
                            <p id="duracao">asd</p> -->
                        </div>
                        <div id="txtChoseseats">
                            <h2>Escolha os assentos</h2>
                        </div>
                    </div>
                </div>
                <div class="seatsChose">
                </div>
                <div id="finishChoice">
                    <a id="anchorFinsh" href="ticketType.php">
                        <input type="button" id="finishButton" value="Finalizar">
                    </a>
                </div>
            </div>
       </div> 
    </div>
    <header>
        <div>
            <a id="homeBAnchor"href="index.php">
                <img id="homeButton" src="img/homeImg.png">
            </a>
        </div>
    </header>
    <main>
        <div class="movieContainer">
            <?php
            
            
            renderMovie($movieId)
            
            ?>
        </div>
        <div class="schedule">
            <h1 id="today"></h1>
            <div class="roomContainer">
                <?=getRooms()?>
            </div>
        </div>
    </main>    
    <script type="module" src="dist/moviePage.js"></script>
</body>
</html>