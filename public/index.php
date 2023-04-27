<?php
    include_once "../src/data.php";
    $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);
    if(!isset($username)){
        header("location:./loginPage.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Movies</title>
</head>
<body>
    <header class="headerIndex">
        <div class="headerContainer">
            <img  id="logo" class="imgFilter" src="img/logo.png" height="50px" width="50px" alt="logo">
            <div>
                <label for="searchMovie">Pesquisar Filme</label><br>
                <input type="text" id="searchMovie" name="seachMovie" id="search">
                <input type="submit" id="searchButton" value="Pesquisar" >
            </div>
            <div class="userHeader">
                <div class="shopCart">
                    <img id="shopCart" class="imgFilter" src="img/shopCart.png" width="40px" height="40px" alt="shop cart">
                    <span id="amount"></span>
                </div>
                <img src="img/logoTest.png" class="imgFilter" id="userIcon" width="40px" height="40px" alt="user icon">
                <div class="username">
                    <h3>Ola,</h3>
                    <h3 id="usernameH3"><?=$username?></h3>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="showOff">

        </div>
        <div class="movies">
            <?php
                
                renderMoviesCard();
            
            ?>
        </div>
    </main>
    <script type="module" src="dist/index.js"></script>
</body>
</html>