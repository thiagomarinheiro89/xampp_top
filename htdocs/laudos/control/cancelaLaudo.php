<?php
    include('config.php');
    
    $sql = "update FATURA set LAUDOOBS = ' ', LAUDOASSOK = 'F' where FATURAID = ".$_GET['id'];
    $query = $pdo->query($sql);
    
    die();

?>