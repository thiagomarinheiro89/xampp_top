<?php
    include("config.php");

    $sql = "SELECT 
                p.PROCID,
                p.MNEMONICO,
                ti.TEXTO
            FROM TEXTOSINFORMATIVOS ti
            inner join PROCTEXTOINFO pti on pti.TEXTOINFOID = ti.TEXTOINFOID
            inner join PROCEDIMENTOS p on p.PROCID = pti.PROCID
            where TIPOTEXTOID = 1";
    
    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    $retorno = array();

    for ($i=0; $i < count($laudos);  $i++) {
        $fp = fopen("teste.rtf", 'a');
        fwrite($fp, $laudos[$i]['TEXTO']);
        fclose($fp);
        die();
    }  
?>