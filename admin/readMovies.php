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
    <div class="modal-container">
        <div class="modal">
            <h1>Deseja realmente excluir o filme?</h1>
            <div>
                <input type="button" class="yesButton" value="Sim">
                <input type="button" class="close" value="Não">
            </div>
            <form id="delForm" method="POST">
                <label for="password">Digite a senha de administrador:</label>
                <input type="password" name="password">
                <div>
                    <input type="submit" id="delButton"value="Exclur">
                </div>
            </form>
            <div class="cancel">
                <input class="close" type="button" value="Cancelar">
            </div>    
        </div>
    </div>
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