<?php
        include("config.php");

        $con = mysqli_connect("localhost","root","","nautaZap");
        
        $sql = "UPDATE msgsus SET data_envio = NOW(), retorno = '".$_POST['retorno']."' WHERE id_mensagem = ".$_POST['id'];
        $bd = mysqli_query($con, $sql) or die(mysqli_error($con));
?>  