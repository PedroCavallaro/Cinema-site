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

function movieInfoSeatsChoice(){
    $movieId = $_COOKIE["movieId"];
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
            
    }
}
function getTicketInfo(){
    $c = 1;
    $db = connect();
    $sql = "SELECT ds_tipo,"
            . " valor FROM tipo_ingresso;";
    $result = $db->query($sql);
    while($data = $result->fetch(PDO::FETCH_ASSOC)){
    echo "<div class='ticketValue'>
        <h2>".$data['ds_tipo']."</h3>
        <h3>R$".$data['valor']."</h3>
        <div>
            <input class='actionButton l' id='$c' type='button' id='lessButton' value='-'>
            <input class='actionButton value' id='$c'  type='button' >
            <input class='actionButton m' id='$c' type='button' id='moreButton' value='+'>
        </div>
    </div>";
    $c++;
    }
}
function getSnacks(){
    $db = connect();
    $sql = "SELECT ds_snack FROM snack";    
    $result = $db->query($sql);
    while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='snackInfo'>
                <h2>".$data['ds_snack']."</h2>
                <div class='type'>
                    <div>
                        ".getSanckType()."
                    </div>
                </div>
            </div>";
    }
}
function getSanckType(){
    $c = 1;
    $db = connect();
    $sql = "SELECT ds_tipo FROM tipo_snack";
    $result = $db->query($sql);
    $html = "";
    while($data = $result->fetch(PDO::FETCH_ASSOC)){
       $html = $html."<div>
        <h3>".convert($data["ds_tipo"])."</h3>
        <div>
            <input class='actionButton l' id='snack".$c."' type='button'd value='-'>
            <input class='actionButton value' id='snack".$c."'  type='button'>
            <input class='actionButton m' id='snack".$c."' type='button' value='+''>      
        </div>
        </div>";
        $c++;
    }
    return $html;

}
function search(){
    $conn = connect();
    $searchValue = filter_input(INPUT_POST, "searchMovie", FILTER_SANITIZE_ENCODED);
    $converted = str_split($searchValue);
    $columnName = "nm_filme";
    $foundMovies = [];
    $c = 0;
    $sql = "SELECT f.id_filme,
                    f.nm_filme,
                    f.duracao,
                    g.id_genero,
                    g.nm_genero,
                    i.ds_idioma
                FROM filme f
                INNER JOIN genero g
                    ON f.id_genero = g.id_genero
                INNER JOIN idioma i
                        ON f.id_idioma = i.id_idioma ";

    $initWhere = "WHERE $columnName LIKE '%$converted[0]%'";
    $whereComands = "";

    for ($i=0; $i < sizeof($converted) ; $i++) { 
       $whereComands = $whereComands."AND ".$columnName." LIKE "."'%$converted[$i]%' ";   
    }
    $result = $conn->query(( $sql.$initWhere.$whereComands));
    
    while($data = $result->fetch(PDO::FETCH_ASSOC)){
        $foundMovies[$c] = $data["id_filme"];
        $c++;
    }

    session_start();
    $_SESSION["foundMovies"] = $foundMovies;  
    if(isset($foundMovies[0])){
        header("location:../public/foundMoviePage.php?search=$searchValue");
        die();  
    }else{
        header("location:../public/foundMoviePage.php?search=$searchValue");
        die();
    }
}
?>

