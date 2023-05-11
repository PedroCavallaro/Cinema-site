<?php

include_once "../src/data.php";


$cod = $_GET["cod"];
$movieName = $_POST["movieName"];
$duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_SPECIAL_CHARS);  
$txtGender = $_POST["txtGender"];
$txtIdioma = $_POST["txtIdioma"];
$txtAudio = $_POST["txtAudio"];
$txtDesc = $_POST["txtDesc"];
$txtPr = $_POST["txtPr"];

$bd = connect();

$sql = "UPDATE `filme` 
        SET `nm_filme`='".$movieName."',
            `id_genero`='".$txtGender."',
            `id_idioma`='".$txtIdioma."',
            `duracao`='".$duration."',
            `id_classificacao`='".$txtPr."',
            `id_audio`='".$txtAudio."',
            `descricao`='".$txtDesc."'
             WHERE id_filme = $cod";

$bd->beginTransaction();
$lines = $bd->exec($sql);
if ($lines == 1){
    $bd->commit();
}
else {
    $bd->rollBack();
}

header("location:../admin/readMovies.php")
?>