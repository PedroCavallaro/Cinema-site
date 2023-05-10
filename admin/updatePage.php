<?php

include_once "../src/data.php";
header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
ini_set('default_charset','UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/addMovie.css">
    <link rel="stylesheet" href="../public/style/common.css">
    <title>Adicionar Filme</title>
</head>
<body>
<header>
        <div>
            <a id="homeBAnchor"href="index.php">
                <img id="homeButton" src="../public/img/homeImg.png">
            </a>
        </div>
    </header>
    <div>
        <form action="../src/update.php" method="post" enctype="multipart/form-data">
            <div class="main-container">
                <div>
                    <img src="" id="tempImg" name="movieImg" class="info">
                    <input id="fileImg"  type="text" name="fileImg" >
                </div>
                    <div class="info-container">
                    <label for="movieName">Nome do filme:</label>
                    <input type="text" id="movieName" class="info" name ="movieName">
                    <div>
                        <label for="duration">Duração:</label><br>
                        <input type="text" id="duration" class="info" name ="duration">
                    </div>
                    <label for="">Genero do Filme:</label>
                    <select name="txtGender">    
                        <?=convert(options())?>
                    </select>
                    <label for="">Idioma:</label>
                    <select name="txtIdioma">    
                        <?=convert(optionsLanguage())?>
                    </select>
                    <label for="">Audio:</label>
                    <select name="txtAudio">    
                        <?=convert(optionsAudio())?>
                    </select>
                    <label>Classificação:</label>
                        <select name="txtPr">
                            <?=parentalrating()?>
                        </select>
                    <label>Descirção:</label>
                    <div class="desc-container" name="txtDesc">
                        <textarea name="txtDesc" cols="70" rows="10" class="info"></textarea>
                    </div>
                </div>
                </div>
            </form>
        </div>
    <script type="module" src="../public/dist/addMovie.js"></script>
</body>
</html>