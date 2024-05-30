<?php
    include("config.php");

    $con = mysqli_connect("localhost","root","","nautaZap");
    $sql = "SELECT id_mensagem, ddd, numero, mensagem FROM msgsus
            WHERE data_envio IS null
            limit 50";
    $bd = mysqli_query($con, $sql) or die(mysqli_error($con));

    $retorno = array();

    while ($row = mysqli_fetch_assoc($bd)) {
        $retorno[] = $row;
    }

    echo json_encode($retorno);
?>