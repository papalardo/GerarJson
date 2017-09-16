<?php

/*

Function By Pablo Papalardo

*/

function gerarJson( ){
    
    $table = array('nome','das','suas', 'tabelas');
    
    $db = new PDO("mysql:host=localhost;dbname=db_name", 'root', '');  
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("set names utf8"); //Garante UTF em versão < 5.3

    for($i=0; $i<count($table); $i++){
        
        $stmt = $db->query("select * from " . $table[$i] );
        $itens = $stmt->fetchAll(PDO::FETCH_OBJ);
        $string = json_encode($itens);
        $arquivo = "json/$table[$i].json";

        $fp = fopen( $arquivo , 'w');
        fwrite($fp, json_encode($string));
        fclose($fp);
        
        echo "$arquivo criado! <br/>";
        
    }
    
}

if (isset($_GET['a']) == 'gerar'){
    echo gerarJson( );
} else {
    echo "<a href='?a=gerar'> Gerar Json's </a>";
}

?>
