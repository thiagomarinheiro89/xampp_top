<?php
    include('config.php');

    $sql = "select top 30 * from (
                                    SELECT 
                                        DISTINCT
                                        P.PACIENTEID,
                                        P.NOME,
                                        P.DOCUMENTO,
                                        P.EMAIL,
                                        P.DATANASC,
                                        P.TELEFONE
                                    FROM FATURA_LAUASSINA FA
                                    INNER JOIN FATURA F ON F.FATURAID = FA.FATURAID
                                    INNER JOIN FATURALAUDO FL ON FL.FATURAID = FA.FATURAID
                                    inner JOIN PACIENTE P ON P.PACIENTEID = F.PACIENTEID
                                    WHERE DATAASSINA >= '2023-07-01'
                                    AND F.LAUDOASSOK = 'T'
                                    AND P.FOTO IS NULL) as d";

    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    echo json_encode($laudos);
    die();
    
?>