<?php
 include("config.php");

 $sql = "select p.PROCID, p.SETORID  from PROCEDIMENTOS p";
 
 $query      = $pdo->query($sql);
 $laudos   = $query->fetchAll();

 $retorno = array();

 for ($i=0; $i < count($laudos);  $i++) {
    $retorno[] = array(
                        "PROCID"=>$laudos[$i]["PROCID"],
                        "SETORID"=>$laudos[$i]["SETORID"]
                       );
 }

 echo json_encode($retorno);
 die();
?>