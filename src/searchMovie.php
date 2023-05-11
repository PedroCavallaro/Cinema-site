<?php

include_once "./data.php";

session_start();
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
                        ON f.id_idioma = i.id_idioma 
                WHERE $columnName LIKE '$searchValue%'";
    $result = $conn->query(( $sql));
    
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

search();




?>