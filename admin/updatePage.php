<?php

include_once "../src/data.php";
header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');
ini_set('default_charset','UTF-8');
$cod =$_GET["cod"];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/common.css">
    <link rel="stylesheet" href="./style/update.css">
    <title>Adicionar Filme</title>
</head>
<body>
<header>
        <div>
            <a id="homeBAnchor"href="./selectAction.php">
                <img id="homeButton" src="../public/img/homeImg.png">
            </a>
        </div>
    </header>
    <div>
        <?php
            echo "<form action='../src/update.php?cod=$cod' method='post' enctype='multipart/form-data'>";        ?>
            <div class="main-container">
                <div>
                    <img src="" id="tempImg" name="movieImg" class="info">
                    <input id="fileImg"  type="text" name="fileImg" >
                </div>
                    <?=renderUpdateMovieInfo($cod)?>
                </div>
            </form>
        </div>
    <script type="module" src="../public/dist/addMovie.js"></script>
</body>
</html>