<?php
function connect(){
    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );

    date_default_timezone_set('Europe/Lisbon');
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
         f.img_path,
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
         f.img_path,
         f.descricao,
         g.id_genero,
         g.nm_genero,
         i.ds_idioma
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma
         WHERE f.id_filme ='$movieId'";
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        echo "<div class='card' id='".$data["id_filme"]."'>
          <a id='imgAncor' href='moviePage.php'> 
        <img src='".$data["img_path"]."'"." class='movieImg' id='movie".$data["id_filme"]."' heigth='10px' width='100px'>
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
        <img src='".$data["img_path"]."'"." class='movieImg' id='movie".$data["id_filme"]."' heigth='10px' width='100px'>
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
    $sql = 'SELECT id_genero,
                    nm_genero
            FROM genero';
    $html = "";
    $result = $conn-> query($sql);
            
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

function optionsAudio(){
    $conn = connect();
    $sql = 'SELECT id_audio,
                    ds_audio
            FROM audio';
    $html = "";
    $result = $conn-> query($sql);
            
    while($data = $result -> fetch(PDO::FETCH_ASSOC)){
        $html = $html."<option value='".$data['id_audio']."'>".$data['ds_audio']."</option>";
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
function renderUpdateMovieInfo($cod){
    $bd = connect();
    $sql = "SELECT f.nm_filme,
                    f.duracao,
                    f.descricao,
                    c.ds_classificacao,
                    c.id_classificacao,
                    i.id_idioma,
                    i.ds_idioma,
                    g.id_genero,
                    g.nm_genero,
                    a.id_audio,
                    a.ds_audio
                    FROM filme f
                    INNER JOIN classificacao c
                    ON f.id_classificacao = c.id_classificacao
                    INNER JOIN idioma i
                    ON f.id_idioma = i.id_idioma
                    INNER JOIN genero g
                    ON f.id_genero = g.id_genero
                    INNER JOIN audio a
                    ON f.id_audio = a.id_audio
                    WHERE f.id_filme = $cod";

    $result = $bd->query($sql);

    $data = $result->fetch(PDO::FETCH_ASSOC);

    $option1 = options();
    $option2 = optionsLanguage();
    $option3 = optionsAudio();
    $option4 = parentalrating();

    echo "  <div class='info-container'>
    <label for='movieName'>Nome do filme:</label>
    <input type='text' id='movieName' class='info name ='movieName' value='".$data["nm_filme"]."'>
    <div>
        <label for='duration'>Duração:</label><br>
        <input type='text' id='duration' class='info' name ='duration' value='".$data["duracao"]."'>
    </div>
    <label for=''>Genero do Filme:</label>
    <select name='txtGender'>
        <option value='".$data["id_genero"]."'>".utf8_encode($data["nm_genero"])."</option>".
        utf8_encode($option1)."
    </select>
    <label for=''>Idioma:</label>
    <select name='txtIdioma'>    
        <option value='".$data["id_idioma"]."'>".utf8_encode($data["ds_idioma"])."</option>"
        . utf8_encode($option2)."
    </select>
    <label for=''>Audio:</label>
    <select name='txtAudio'>    
        <option value='".$data["id_audio"]."'>".$data["ds_audio"]."</option>"
        .$option3."
    </select>
    <label>Classificação:</label>
        <select name='txtPr'>
        <option value='".$data["id_classificacao"]."'>".$data["ds_classificacao"]."</option>"
        .$option4."
        </select>
    <div class='subButton' id='updateButton'>
        <input type='submit' value='Atualizar'>
    </div>
    <label>Descrição:</label>
    <div class='desc-container' name='txtDesc'>
        <textarea name='txtDesc' cols='70' rows='10' class='info'>
        ".$data["descricao"]."</textarea>
    </div>
</div>";



}
?>

