<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/login.css">
    <title>Login</title>
</head>
<body>
    <form action="../src/main.php" method="post">
       <div class="container">
            <div class="title">
                <h1>Login</h1>
            </div>
            <div class="info-container">
                <div>
                    <label for="username">Usuário</label><br>
                    <input type="text" id="username" name="username"><br>
                </div>
                <div class="passContainer">
                    <label for="password">Senha</label><br>
                    <input type="password" id="password" name="password">
                    <input type="submit" value="Entrar"><br>
                 </div>
                     <a href="../public/registerPage.php">Não tem conta? Cadastre-se</a>
                </div>
            </div>
    </form>
    
</body>
</html>