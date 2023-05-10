<?php
function connect(){
    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
<<<<<<< HEAD
=======
    date_default_timezone_set('Europe/Lisbon');
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
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
<<<<<<< HEAD

=======
function renderMovie($movieId){
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
            <p class='infoP' id='sinopse'>SINÓPSE:</p>
            <p> ".convert($data["descricao"])."</p>
            <p id='movieTime".$data["id_filme"]."' class='infoP'>DURAÇÂO:</p>
            <p> ". $data["duracao"]." min
            <p class='infoP'>GÊNERO:</p>
            <p> ".convert($data["nm_genero"])."</p>
            <p class='infoP'>ÁUDIO: </p>
            <p>".convert($data["ds_idioma"])."</p>
        </div>
    </div>
</div>";
}
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
function renderFoundMovie($movieId){
    $conn = connect();
    $sql =  "SELECT 
         f.id_filme,
         f.nm_filme,
         f.duracao,
         f.descricao,
         g.id_genero,
         g.nm_genero,
<<<<<<< HEAD
         i.ds_idioma
=======
         i.ds_idioma,
         sa.nm_sala,
         de.descricao
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma
<<<<<<< HEAD
=======
         INNER JOIN salas sa
         ON f.id_sala = sa.id_sala
         INNER JOIN descricao de
         ON f.id_descricao = de.id_descricao
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
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

function options(){
    $conn = connect();
<<<<<<< HEAD
    $sql = 'SELECT id_genero,
                    nm_genero
            FROM genero';
    $html = "";
    $result = $conn-> query($sql);
=======
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
         ON f.id_idioma = i.id_idioma
         INNER JOIN salas sa
         ON f.id_sala = sa.id_sala
         WHERE f.id_filme ='$movieId'";
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);

        return "<h1 id='movieId".$data["id_filme"]."' class='modalInfo'>".$data["nm_filme"]."</h1>
                <p id='movieTime".$data["id_filme"]."' class='modalInfo'>Duração: ". $data["duracao"]." min
                <p class='modalInfo'>Gênero: ".convert($data["nm_genero"])."</p>
                <p id='roomPick' class='modalInfo'></p>
                <p id='roomTime' class='modalInfo'>Horario: </p>";
}

function getRooms(){

    $movieId = $_COOKIE["movieId"];
    $conn = connect();
    $sql =  "SELECT  e.horario,
            s.nm_sala,
            d.data,
            f.id_filme
            FROM escala e
            INNER JOIN filme f
            ON e.id_filme = f.id_filme
            INNER JOIN salas s
            ON e.id_sala = s.id_sala
            INNER JOIN data d
            ON d.id_data = e.id_data
            WHERE f.id_filme = $movieId
            ORDER BY s.nm_sala ASC";

     $result = $conn->query($sql);
     
     while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo "
            <div class='room'>
                    <h3>".$data["nm_sala"]."</h3>
                    <p>".$data["horario"]."</p>
                </div>";
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
            
    while($data = $result -> fetch(PDO::FETCH_ASSOC)){
        $html = $html."<option value='".$data['id_genero']."'>".$data['nm_genero']."</option>";
    }
    return $html;
}
function optionsLanguage(){
    $conn = connect();
    $sql = 'SELECT id_idioma,
                    ds_idioma
            FROM idioma';
    $html = "";
    $result = $conn-> query($sql);
            
    while($data = $result -> fetch(PDO::FETCH_ASSOC)){
        $html = $html."<option value='".$data['id_idioma']."'>".$data['ds_idioma']."</option>";
    }
    return $html;
}

<<<<<<< HEAD
function optionsAudio(){
    $conn = connect();
    $sql = 'SELECT id_audio,
                    ds_audio
            FROM audio';
    $html = "";
    $result = $conn-> query($sql);
            
    while($data = $result -> fetch(PDO::FETCH_ASSOC)){
        $html = $html."<option value='".$data['id_audio']."'>".$data['ds_audio']."</option>";
=======
    session_start();
    $_SESSION["foundMovies"] = $foundMovies;  
    if(isset($foundMovies[0])){
        header("location:../public/foundMoviePage.php?search=$searchValue");
        die();  
    }else{
        header("location:../public/foundMoviePage.php?search=$searchValue");
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
    }
    return $html;
}

function roomOptions(){
    $conn = connect();
    $sql = 'SELECT id_sala,
                    nm_sala
            FROM salas';
    $html = "";
    $result = $conn-> query($sql);
            
    while($data = $result -> fetch(PDO::FETCH_ASSOC)){
        $html = $html."<option value='".$data['id_sala']."'>".$data['nm_sala']."</option>";
    }
    return $html;
}
function parentalrating(){
    $conn = connect();
    $sql = 'SELECT id_classificacao,
                    ds_classificacao
            FROM classificacao';
    $html = "";
    $result = $conn-> query($sql);
            
    while($data = $result -> fetch(PDO::FETCH_ASSOC)){
        $html = $html."<option value='".$data['id_classificacao']."'>".$data['ds_classificacao']." anos</option>";
    }
    return $html;
}
?>

