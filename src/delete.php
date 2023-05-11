<?php
include_once "data.php";
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_SPECIAL_CHARS);
$bd = connect();
$sql = "SELECT password
        FROM user 
        WHERE username = 'admin'";

    $result = $bd->query($sql);

    $data = $result->fetch(PDO::FETCH_ASSOC);

    if($password != $data["password"]){
        header("location:../admin/readMovies.php");
    }else{
        $sql = "DELETE FROM filme
                    WHERE id_filme = $cod";

        $bd->beginTransaction();
        $lines = $bd->exec($sql);

        if ($lines == 1){
            $bd->commit();
            header("location:../admin/readMovies.php");
        }
        else {
            $bd->rollBack();
        }

    }

?>