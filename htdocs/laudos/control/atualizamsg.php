<?php
    $con = mysqli_connect("localhost","root","","nautaZap");
    $sql = "UPDATE filamsg SET disparo = now(), 
            retorno = '".json_encode($_POST['retorno'])."' where faturaId = ".$_POST['fatura'];
    $bd = mysqli_query($con, $sql) or die(mysqli_error($con));
?>