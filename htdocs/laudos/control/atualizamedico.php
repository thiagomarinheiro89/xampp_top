<?php
    include('config.php');
    
    $sql = "update MEDICOS set CONFIGURAVEL5 = 1 where MEDICOID = ".$_GET['id'];
    $query      = $pdo->query($sql);
    
    die();

?>