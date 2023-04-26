<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="../src/main.php" method="post">
       <div class="container">
           <h1>Login</h1>
           <label for="username">Usuário</label><br>
           <input type="text" id="username" name="username"><br>
           <label for="password">Senha</label><br>
           <div class="passContainer">
               <input type="password" id="password" name="password">
               <input type="submit" value="Entrar"><br>
           </div>
       </div>
    </form>
    <a href="../public/registerPage.php">Não tem conta? Cadastre-se</a>
</body>
</html>