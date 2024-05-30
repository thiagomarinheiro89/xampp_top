<?php
    include("config.php");

    $sql = "select 
                top 100
                f.FATURAID,
                p.PACIENTEID,
                p.NOME,
                pr.PROCID,
                case when f.MEDREAID = '' then 0 else f.MEDREAID end as MEDREAID,
                f.ENTREGADATA,
                f.DATA
            from FATURA f
            inner join PACIENTE p on p.PACIENTEID = f.PACIENTEID
            inner join procedimentos pr on pr.PROCID = f.PROCID
            left join integra_pacs ipac on ipac.FATURAID = f.FATURAID
            LEFT JOIN CONVENIOS c ON c.CONVENIOID = f.CONVENIOID
            where 
            ENTREGADATA >= '2024-04-01' 
            AND C.DESCRICAO NOT LIKE 'PARTICULAR ( A )'
            AND C.DESCRICAO NOT LIKE 'PARTICULAR ( F )'
            AND ipac.DATA is null 
            ORDER BY entregadata desc";
    
    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    $retorno = array();

    for ($i=0; $i < count($laudos);  $i++) {
        $retorno[] = array(
                            "FATURAID" => utf8_encode($laudos[$i]["FATURAID"]),
                            "PACIENTEID" => $laudos[$i]["PACIENTEID"],
                            "NOME" => utf8_encode($laudos[$i]["NOME"]),
                            "PROCEDIMENTO" => utf8_encode($laudos[$i]["PROCID"]),
                            "MEDREAID" => $laudos[$i]["MEDREAID"],
                            "ENTREGADATA" => $laudos[$i]["ENTREGADATA"],
                            "DATA" => $laudos[$i]["DATA"]    
        );
    }
        
    echo json_encode($retorno);
    die();
?>