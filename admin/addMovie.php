<?php

include_once "../src/data.php";
header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
ini_set('default_charset','UTF-8');


session_start();
echo $_SESSION["adminLogged"];
if($_SESSION["adminLogged"] != "admin") {
    header("location:../public/loginPage.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/common.css">
    <link rel="stylesheet" href="./style/addMovie.css">
    <title>Adicionar Filme</title>
</head>
<header>
    <div>
        <a href="./selectAction.php">
            <img src="../public/img/leftArrow.png" id="logo"alt="">
        </a>
    </div>
    <div class="searchContainer">
        <label for="searchMovie">Pesquisar filme:</label><br>
        <input type="text" id="searchMovie">
        <input type="button" id="search" value="Pesquisar"><br>
        <div id="list">
            <div id="list"></div>
        </div>
    </div>
    <div></div>
</header>
<body>
    <div>
        <form action="../src/addMovie.php" method="post" enctype="multipart/form-data">
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
                    <label>Descrição:</label>
                    <div class="desc-container" name="txtDesc">
                        <textarea name="txtDesc" cols="70" rows="10" class="info"></textarea>
                    </div>
                </div>
                <div class="date-contanier">
                    <h1>Gerar escala</h1>
                    <label for="realease">Data de lançamento</label>
                    <input type="text" class="info" name="txtRelease">
                    <label>Periodo de exibição</label>
                    <input type="date">
                        <label>Horario:</label>
                        <input type="text" placeholder="00:00" name="time">
                        <label>Sala:</label>
                        <select name="txtRoom">
                            <?=roomOptions()?>
                        </select>
                        
                    <div class="subButton">
                        <input type="submit" value="Cadastrar">
                    </div>
                    </div>
                </div>
                
            </form>
        </div>
    <script type="module" src="../public/dist/addMovie.js"></script>
</body>
</html>