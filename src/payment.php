<?php
include_once "../src/data.php";
function paymentMethods(){
    $bd = connect();
    $sql = "SELECT * 
            FROM metodo_pagamento";

    $result = $bd->query($sql);

    while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo " <label for='pix'>
                    <input type='radio' name='txtMethod' id='pix' value='".$data["id_metodo"]."'>
                    <img src='./img/method".$data["id_metodo"].".png' class='imgMethod' draggable='false'>
                </label>
                <label for='pix'>".utf8_encode($data["nm_metodo"])."</label>";
            
    }


}