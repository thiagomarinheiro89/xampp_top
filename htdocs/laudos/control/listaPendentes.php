<?php
    include('config.php');

    $sql = "select distinct PACIENTEID from PACIENTEPENDENCIAS
            where DATA_OK is null";
    $query      = $pdo->query($sql);
    $pacientes   = $query->fetchAll();

    echo json_encode($pacientes);
    die();
?>