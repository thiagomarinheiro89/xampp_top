<?php
    $con = mysqli_connect("localhost","root","","nautaZap");
    $sql = "INSERT INTO filamsg (faturaId, numero, nome_paciente, procedimento, criacao) VALUES
                        ('".$_POST["faturaId"]."', '".$_POST["numero_celular"]."', '".$_POST["nome_cliente"]."', '".$_POST["nome_procedimento"]."',NOW())";
    $bd = mysqli_query($con, $sql) or die(mysqli_error($con));

?>