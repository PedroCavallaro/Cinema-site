<?php


include_once "../src/readMovies.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/common.css">
    <link rel="stylesheet" href="style/readMovie.css">
    <title>Lista de filmes</title>
</head>
<body>
<header>
        <div>
            <a id="homeBAnchor"href="./selectAction.php">
                <img id="homeButton" src="../public/img/leftArrow.png">
            </a>
        </div>
    </header>
    <table>
        <thead>
            <th>Poster</th>
            <th>Cód Filme</th>
            <th>Nome do filme</th>
            <th>Classificação</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?=renderList()?>   
        </tbody>
    </table>
    <script src="../public/dist/readMovies.js"></script>
</body>
</html>