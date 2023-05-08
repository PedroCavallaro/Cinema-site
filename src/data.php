<?php
function connect(){
    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
    $dsn = "mysql:host=localhost;dbname=cinema2";
    $username="root";
    $password ="";
    $conn = new PDO($dsn, $username, $password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,
                          PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function searchUser($username, $password){
    $bd = connect();
    $sql = "SELECT username,password 
            FROM user 
            WHERE username = '$username' 
            AND password =  '$password';";

    $result = $bd->query($sql);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data;
               
}

function searchUsername($username){
    $bd = connect();
    $sql = "SELECT username,password 
            FROM user 
            WHERE username = '$username';";

    $result = $bd->query($sql);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    
    return $data;
                
}


function registerUser($username, $password){
    $bd = connect();
    $testUser = searchUsername($username, $password);
    
    if($testUser["username"] == $username){
        header("location:../public/registerPage.php?already=1");
    }else{
        $sql = "INSERT INTO user (username, password) 
                VALUES ('$username', '$password')";
    
        $bd->beginTransaction();
        $lines = $bd->exec($sql);
        
        if($lines == 1){
            $bd->commit();
            header("location:../public/loginPage.php");
        }else{
            $bd->rollBack();
        }
    }
}
function renderMoviesCard(){
    $conn = connect();
    $sql =  "SELECT 
         f.id_filme,
         f.nm_filme,
         f.duracao,
         g.id_genero,
         g.nm_genero,
         i.ds_idioma
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma";
     $result = $conn->query($sql);
     
     while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo renderCard($data);
    }
}

function convert($data){
    return mb_convert_encoding($data, 'UTF-8', 'ISO-8859-1');
}

function renderFoundMovie($movieId){
    $conn = connect();
    $sql =  "SELECT 
         f.id_filme,
         f.nm_filme,
         f.duracao,
         g.id_genero,
         g.nm_genero,
         i.ds_idioma,
         sa.nm_sala,
         de.descricao
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma
         INNER JOIN salas sa
         ON f.id_sala = sa.id_sala
         INNER JOIN descricao de
         ON f.id_descricao = de.id_descricao
         WHERE f.id_filme ='$movieId'";
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        echo "<div class='card' id='".$data["id_filme"]."'>
          <a id='imgAncor' href='moviePage.php'> 
        <img src='./img/filme_id".$data["id_filme"].".jpg'"." class='movieImg' id='movie".$data["id_filme"]."' heigth='10px' width='100px'>
        </a>".
    "<div class='movieContentContainer'>
        <h1 id='movieId".$data["id_filme"]."'>".$data["nm_filme"]."</h1>
        <div class='movieContent'>
            <p id='movieTime".$data["id_filme"]."'>Duração | ". $data["duracao"]." min</p>
            <p>Gênero | ".convert($data["nm_genero"])."</p>
            <p>Áudio | ".convert($data["ds_idioma"])."</p>
        </div>
    </div>
</div>";
}
function renderCard($data){
    return "<div class='card' id='".$data["id_filme"]."'>
    
        <a id='imgAncor' href='moviePage.php'> 
        <img src='./img/filme_id".$data["id_filme"].".jpg'"." class='movieImg' id='movie".$data["id_filme"]."' heigth='10px' width='100px'>
        </a>".
    "<div class='movieContentContainer'>
        <h1 id='movieId".$data["id_filme"]."'>".$data["nm_filme"]."</h1>
        <div class='movieContent'>
            <p id='movieTime".$data["id_filme"]."'>Duração | ". $data["duracao"]." min</p>
            <p>Gênero | ".convert($data["nm_genero"])."</p>
            <p>Áudio | ".convert($data["ds_idioma"])."</p>
        </div>
    </div>
</div>";
}



?>

