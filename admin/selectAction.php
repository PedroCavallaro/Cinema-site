<?php

session_start();
if($_SESSION["logged"] != "admin") {
    header("location:../public/loginPage.php");
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style/common.css">
    <link rel="stylesheet" href="style/select.css">
    <title>Admin</title>
</head>
<body>
    <header>
        <div>
            <a id="homeBAnchor" href="../public/index.php">
                <img id="homeButton" src="../public/img/homeImg.png">
            </a>
        </div>
    </header>
    <div id="adminTitle">
        <h1>Página de adminstrador</h1>
    </div>
    <div class="actions-container">
        <div>
            <a href="./addMovie.php">
                <img src="../public/img/addButton.png" alt="">
                <h1>Adicionar Filme</h1>
            </a>
        </div>
        <div>
            <a href="./readMovies.php">
                <img src="../public/img/list.png" alt="">
                <h1>Ver filmes cadastrados</h1>
            </a>
        </div>
        <div>
            <a href="">
                <img src="../public/img/schedule.png" alt="">
                <h1>Editar/adicionar escalas</h1>
            </a>
        </div>
    </div>
</body>
</html>