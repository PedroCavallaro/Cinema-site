<!DOCTYPE html>
<?php

include_once "../src/data.php";
$movieId = $_COOKIE["movieId"];




?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <?php
                            
                               echo movieInfoSeatsChoice()
                            ?>
                            <!-- <p id="movieName">asd</p>
                            <p id="duracao">asd</p> -->
                            <p id="ticketAmount">Assentos |</p>
                        </div>
                    </div>
                </div>
                <div class="seatsChose">
                </div>
            </div>
       </div> 
    </div>
    <header>
        <div>
            <a href="index.php">
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
    <script src="dist/moviePage.js"></script>
</body>
</html>