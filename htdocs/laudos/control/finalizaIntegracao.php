<?php
    include('config.php');
    
    $sql = "INSERT INTO integra_pacs (FATURAID, DATA, ACCESSIONNUMBER, UNIDADEID, PACIENTEID) values (".$_GET['id'].", getdate(), 'Nauta Laudos', 0, '0000')";
    $query      = $pdo->query($sql);
    
    die();


?>