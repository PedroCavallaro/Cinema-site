<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/register.css">
    <title>Cadastro</title>
</head>
<body>
    <header class="header">
        <div>
            <a href="loginPage.php"><img src="./img/homeImg.png" alt="home"></a>
        </div>
    </header>
    <form action="../src/register.php" method="post">
        <div class="mainContainer">
            <div class="container">
                <div class="titlle">
                    <h1>Cadastro</h1>
                </div>
                <div>
                    <label for="username">Usuário</label><br>
                    <input type="text" id="username" name="username"><br>
                    <div class="passContainer"></div>
                        <label for="password">Senha</label><br>
                        <input type="password" id="password" name="password">
                    <div class="foot">
                        <input type="submit" id="registerButton" value="Cadastrar"><br>
                        <span id="spanError"></span>
                    </div>
                </div>
            </div>
       </div>
    </form> 
<script src="../public/dist/register.js"></script>
</body>
</html>