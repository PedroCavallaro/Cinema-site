<?php
include_once "../src/data.php";
function getSanckType($data){
    $c = 1;
    $db = connect();
    $sql = "SELECT ds_tipo FROM tipo_snack";
    $result = $db->query($sql);
    $html = "";
   
       $html = "<div>
        <div>
            <input class='actionButton bomboniere l' id='snack".$c."'  data-name='".utf8_encode($data['ds_snack'])."' data-value='".$data['valor']."' type='button'd value='-'>
            <input class='actionButton bomboniere value' id='snack".$c."'  type='button'>
            <input class='actionButton bomboniere m' id='snack".$c."' data-name='".utf8_encode($data['ds_snack'])."' data-value='".$data['valor']."' type='button' value='+''>      
        </div>
        </div>";
        $c++;

    return $html;

}

function getSnacks(){
    $db = connect();
    $sql = "SELECT ds_snack, 
                    valor
                     FROM snack";    
    $result = $db->query($sql);
    while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo "<div class='snackInfo'>
                <h2>".convert($data['ds_snack'])."</h2>
                <div class='snackValue'>
                    <h2>R$".$data['valor']."</h2>
                </div>
                <div class='type'>
                    <div>
                        ".getSanckType($data)."
                    </div>
                </div>
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
            <input class='actionButton l ticket' type='button' id='lessButton' data-name='".utf8_encode($data['ds_tipo'])."' data-value='".$data['valor']."' value='-'>
            <input class='actionButton value'   type='button' >
            <input class='actionButton m ticket'  type='button' id='moreButton' data-name='".utf8_encode($data['ds_tipo'])."' data-value='".$data['valor']."' value='+'>
        </div>
    </div>";
    $c++;
    }
}



?>