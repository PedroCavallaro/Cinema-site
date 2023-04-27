<?php

function connect(){
    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
    date_default_timezone_set('Europe/Lisbon');
    $dsn = "mysql:host=localhost;dbname=cinema";
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
         i.ds_idioma,
         sa.nm_sala,
         d.horario
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma
         INNER JOIN salas sa
         ON f.id_sala = sa.id_sala
         INNER JOIN data d
         ON f.id_data = d.id_horario";
     $result = $conn->query($sql);
     
     while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo renderCard($data);
    }
}

function convert($data){
    if($data["id_genero"] == "1"){
        return "ação";
    }
    else if($data["id_genero"] == "2"){
        return "animação";
    }else {
        return $data["nm_genero"];
    }
}
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
         d.horario,
         de.descricao
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma
         INNER JOIN salas sa
         ON f.id_sala = sa.id_sala
         INNER JOIN data d
         ON f.id_data = d.id_horario
         INNER JOIN descricao de
         ON f.id_descricao = de.id_descricao
         WHERE f.id_filme ='$movieId'";
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        echo "<div class='card' id='".$data["id_filme"]."'>
          <a id='imgAncor' href='moviePage.php?username='> 
        <img src='./img/filme_id".$data["id_filme"].".jpg'"." class='movieImg' id='movie".$data["id_filme"]."' heigth='10px' width='100px'>
        </a>".
    "<div class='movieContentContainer'>
        <h1 id='movieId".$data["id_filme"]."'>".$data["nm_filme"]."</h1>
        <div class='movieContent'>
            <p class='infoP' id='sinopse'>SINÓPSE:</p>
            <p> ".mb_convert_encoding($data["descricao"], 'UTF-8', 'ISO-8859-1')."</p>
            <p id='movieTime".$data["id_filme"]."' class='infoP'>DURAÇÂO:</p>
            <p> ". $data["duracao"]." min
            <p class='infoP'>GÊNERO:</p>
            <p> ".convert($data)."</p>
            <p class='infoP'>ÁUDIO: </p>
            <p>".$data["ds_idioma"]."</p>
        </div>
    </div>
</div>";
}
function renderCard($data){
    $username = filter_input(INPUT_GET, "username", FILTER_SANITIZE_STRING);
    return "<div class='card' id='".$data["id_filme"]."'>
    
        <a id='imgAncor' href='moviePage.php?username=".$username."'> 
        <img src='./img/filme_id".$data["id_filme"].".jpg'"." class='movieImg' id='movie".$data["id_filme"]."' heigth='10px' width='100px'>
        </a>".
    "<div class='movieContentContainer'>
        <h1 id='movieId".$data["id_filme"]."'>".$data["nm_filme"]."</h1>
        <div class='movieContent'>
            <p id='movieTime".$data["id_filme"]."'>Duração | ". $data["duracao"]." min
            <p>Gênero | ".convert($data)."</p>
            <p>Áudio | ".$data["ds_idioma"]."</p>
        </div>
    </div>
</div>";
}

function movieInfoSeatsChoice(){
    $movieId = $_COOKIE["movieId"];
    $conn = connect();
    $sql =  "SELECT 
         f.id_filme,
         f.nm_filme,
         f.duracao,
         g.id_genero,
         g.nm_genero,
         i.ds_idioma,
         sa.nm_sala,
         d.horario
         FROM filme f
         INNER JOIN genero g
         ON f.id_genero = g.id_genero
         INNER JOIN idioma i
         ON f.id_idioma = i.id_idioma
         INNER JOIN salas sa
         ON f.id_sala = sa.id_sala
         INNER JOIN data d
         ON f.id_data = d.id_horario
         WHERE f.id_filme ='$movieId'";
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);

        return "<h1 id='movieId".$data["id_filme"]."'>".$data["nm_filme"]."</h1>
                <p id='movieTime".$data["id_filme"]."'>Duração: ". $data["duracao"]." min
                <p>Gênero: ".convert($data)."</p>
                <p id='roomPick'></p>
                <p id='roomTime'>Horario: </p>";
}

function getRooms(){
    $conn = connect();
    $sql =  "SELECT s.nm_sala,
                    s.id_sala,
                    d.horario
            FROM salas s
            INNER JOIN data d
            ON s.id_sala = d.id_horario";

     $result = $conn->query($sql);
     
     while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo "
            <div class='room'>
                    <h3>".$data["nm_sala"]."</h3>
                    <p>".$data["horario"]."</p>
                </div>";
            
    }
}
?>

