<?php
    include('config.php');
    
    $sql = "update FATURA set LAUDOOBS = 'importado Web' where FATURAID = ".$_GET['id'];
    $query      = $pdo->query($sql);
    
    die();

?>