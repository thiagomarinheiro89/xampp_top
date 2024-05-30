<?php
    include('config.php');
    
    $sql = "select PROCID, DESCRICAO, MNEMONICO  from procedimentos";

    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    echo json_encode($laudos);
    die();
    
?>