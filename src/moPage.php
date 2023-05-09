<?php
include_once "../src/data.php";

function getRooms(){

    $movieId = $_COOKIE["movieId"];
    $conn = connect();
    $sql =  "SELECT  e.horario,
            s.nm_sala,
            f.id_filme
            FROM escala e
            INNER JOIN filme f
            ON e.id_filme = f.id_filme
            INNER JOIN salas s
            ON e.id_sala = s.id_sala
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
         WHERE f.id_filme ='$movieId'";
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);

        return "<h1 id='movieId".$data["id_filme"]."' class='modalInfo'>".$data["nm_filme"]."</h1>
                <p id='movieTime".$data["id_filme"]."' class='modalInfo'>Duração: ". $data["duracao"]." min
                <p class='modalInfo'>Gênero: ".convert($data["nm_genero"])."</p>
                <p id='roomPick' class='modalInfo'></p>
                <p id='roomTime' class='modalInfo'>Horario: </p>";
}

function renderMovie($movieId){
    $conn = connect();
    $sql =  "SELECT 
         f.id_filme,
         f.nm_filme,
         f.descricao,
         f.duracao,
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



?>