<?php
include_once "./data.php";
header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL,'pt_BR.UTF8');
mb_internal_encoding('UTF8'); 
mb_regex_encoding('UTF8');

$movieName = $_POST["movieName"];
$duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_SPECIAL_CHARS);  
$txtGender = $_POST["txtGender"];
$txtIdioma = $_POST["txtIdioma"];
$txtAudio = $_POST["txtAudio"];
$txtDesc = $_POST["txtDesc"];
$txtRoom = $_POST["txtRoom"];
$time = $_POST["time"];
$txtRelease = $_POST["txtRelease"];
$txtPr = $_POST["txtPr"];

echo $txtDesc;


$bd = connect();

$sql = "INSERT INTO `filme`(`nm_filme`,
                `id_genero`, `id_idioma`, `duracao`
                ,`id_classificacao`, `descricao`,
                 `id_audio`, `dt_lancamento`) 
                    VALUES ('".utf8_decode($movieName)."','".$txtGender."','".$txtIdioma."','".$duration."',
                    '".$txtPr."','".utf8_decode($txtDesc)."','".$txtAudio."','".$txtRelease."')";

$bd->beginTransaction();
$lines = $bd->exec($sql);
if ($lines == 1){
    $bd->commit();
}
else {
    $bd->rollBack();
}

header("location:../admin/addMovie.php")

?>