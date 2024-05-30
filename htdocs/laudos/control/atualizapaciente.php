<?php
    include('config.php');
    
    $sql = "update PACIENTE set FOTO = '' where PACIENTEID = ".$_GET['id'];
    $query      = $pdo->query($sql);
    
    die();

?>