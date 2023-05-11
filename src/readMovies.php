<?php
include_once "../src/data.php";


function renderList(){
    $bd = connect();
    $sql = "SELECT f.id_filme,
            f.nm_filme,
            c.ds_classificacao,
            f.img_path
            FROM filme f
            INNER JOIN classificacao c
            ON f.id_classificacao = c.id_classificacao";
    $c =0;
    $result = $bd->query($sql);
    while($data = $result->fetch(PDO::FETCH_ASSOC)){
        echo "
        <tr>
        <td class='tdImg'><img class='imgList' src='".$data["img_path"]."' draggable='false'></td>
              <td>".$data["id_filme"]."</td> 
              <td>".$data["nm_filme"]."</td>  
              <td>".$data["ds_classificacao"]."</td>
              <td>
                <a class='updateButton' href='updatePage.php?cod=".$data["id_filme"]."'>Editar</a>
                <a class='delete' data-href='cod=".$data["id_filme"]."'>Excluir</a>
               </td>
              </tr> ";
        $c++;
    }

//href='updatePage.php?cod=".$data["id_filme"]."'
}