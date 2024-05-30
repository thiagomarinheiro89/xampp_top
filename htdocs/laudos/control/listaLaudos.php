<?php
    include("config.php");

    $sql = "SELECT 
                TOP 30
                F.FATURAID,
                F.REQUISICAOID, 
                F.PACIENTEID, 
                F.PROCID, 
                F.DATA, 
                FA.DATAASSINA, 
                F.MEDSOLID, 
                F.MEDREAID,  
                FL.LAUDO,
                C.DESCRICAO AS CONV,
                F.UNIDADEID
            FROM FATURA_LAUASSINA FA
            INNER JOIN FATURA F ON F.FATURAID = FA.FATURAID
            INNER JOIN FATURALAUDO FL ON FL.FATURAID = FA.FATURAID
            inner join convenios C on C.CONVENIOID = F.CONVENIOID
            WHERE DATAASSINA >= '2023-07-01'
            AND F.LAUDOASSOK = 'T'
            AND isnull(f.LAUDOOBS, '') not like '%importado Web%'";
    
    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    $retorno = array();

    for ($i=0; $i < count($laudos);  $i++) {
        $retorno[] = array(
                            "FATURAID"=>$laudos[$i]['FATURAID'], 
                            "REQUISICAOID"=>$laudos[$i]['REQUISICAOID'], 
                            "PACIENTEID"=>$laudos[$i]['PACIENTEID'], 
                            "PROCID"=>$laudos[$i]['PROCID'],
                            "DATA"=>$laudos[$i]['DATA'],
                            "DATA_ASSINATURA"=>$laudos[$i]['DATAASSINA'],
                            "MEDSOLID"=>$laudos[$i]['MEDSOLID'],
                            "MEDID"=>$laudos[$i]['MEDREAID'],
                            "LAUDO"=>base64_encode(utf8_encode($laudos[$i]['LAUDO'])),
                            "CONVENIO" => $laudos[$i]['CONV'],
                            "UNIDADEID" => $laudos[$i]['UNIDADEID']
                            );
    }  

    $sql = "SELECT 
                TOP 50
                F.FATURAID,
                F.REQUISICAOID, 
                F.PACIENTEID, 
                F.PROCID, 
                F.DATA, 
                NULL AS DATAASSINA, 
                F.MEDSOLID, 
                F.MEDREAID,  
                NULL AS LAUDO,
                C.DESCRICAO AS CONV,
                F.UNIDADEID
            FROM FATURA F
            INNER JOIN PROCEDIMENTOS P ON P.PROCID = F.PROCID
            INNER JOIN CONVENIOS C ON C.CONVENIOID = F.CONVENIOID 
            WHERE (isnull(f.LAUDOOBS, '') not like '%importado Web%' AND F.DATA > '2024-01-01' AND P.MNEMONICO = 'MIOREP1');";

    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    for ($i=0; $i < count($laudos);  $i++) {
        $retorno[] = array(
                            "FATURAID"=>$laudos[$i]['FATURAID'], 
                            "REQUISICAOID"=>$laudos[$i]['REQUISICAOID'], 
                            "PACIENTEID"=>$laudos[$i]['PACIENTEID'], 
                            "PROCID"=>$laudos[$i]['PROCID'],
                            "DATA"=>$laudos[$i]['DATA'],
                            "DATA_ASSINATURA"=>$laudos[$i]['DATAASSINA'],
                            "MEDSOLID"=>$laudos[$i]['MEDSOLID'],
                            "MEDID"=>$laudos[$i]['MEDREAID'],
                            "LAUDO"=>base64_encode(utf8_encode($laudos[$i]['LAUDO'])),
                            "CONVENIO" => $laudos[$i]['CONV'],
                            "UNIDADEID" => $laudos[$i]['UNIDADEID']
                            );
    }
    
      
    echo json_encode($retorno);
    die();
?>