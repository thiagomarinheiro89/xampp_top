<?php
  $con = mysqli_connect("localhost", "root", "", "nautazap");
  $sql = "SELECT * FROM filamsg
          WHERE disparo IS null";
  $bd = mysqli_query($con, $sql);

  $retorno = array();
  
  include("control/config.php");

  while ($row = mysqli_fetch_assoc($bd)) {
      $fatura = $row['faturaId'];
        
      if ($fatura != '') {
        $sql = "SELECT P.NOME, P.DDD, P.TELEFONE, PR.DESCRICAO FROM FATURA F 
                        INNER JOIN PACIENTE P ON P.PACIENTEID = F.PACIENTEID 
                        INNER JOIN PROCEDIMENTOS PR ON PR.PROCID = F.PROCID 
                        WHERE F.FATURAID = '$fatura'";
        $query   = $pdo->query($sql);
        $dados   = $query->fetchAll();

        $pontos = array("(",")", "-", " ",".");
        $numero = ($dados[0]["DDD"]==null?"65":str_replace($pontos, "", $dados[0]["DDD"]));
        $numero .= str_replace($pontos, "", $dados[0]["TELEFONE"]);

        $retorno[] = array(
                                "nome" => substr($dados[0]["NOME"], 0, strpos($dados[0]["NOME"], " ")),
                                "numero" => $numero,
                                "procedimento" => $dados[0]["DESCRICAO"],
                                "faturaId" => $row['faturaId']
                                );
     }
  }

  echo json_encode($retorno);

?>