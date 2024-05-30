<?php
    include('config.php');
    
    $sql = "SELECT TOP 30 * FROM (
                                    SELECT 
                                        DISTINCT
                                        M.MEDICOID,
                                        M.NOME,
                                        CONCAT(M.ABREVIACAO, ': ', M.CRM) as documento,
                                        'Médico' AS titulo
                                    FROM FATURA_LAUASSINA FA
                                    INNER JOIN FATURA F ON F.FATURAID = FA.FATURAID
                                    INNER JOIN MEDICOS M ON M.MEDICOID = F.MEDSOLID
                                    WHERE DATAASSINA >= '2023-07-01'
                                    AND F.LAUDOASSOK = 'T'
                                    AND M.CONFIGURAVEL5 IS NULL
                                    UNION 
                                    SELECT 
                                        DISTINCT
                                        M.MEDICOID,
                                        M.NOME,
                                        CONCAT(M.ABREVIACAO, ': ', M.CRM) as documento,
                                        'Médico' AS titulo
                                    FROM FATURA_LAUASSINA FA
                                    INNER JOIN FATURA F ON F.FATURAID = FA.FATURAID
                                    INNER JOIN MEDICOS M ON M.MEDICOID = F.MEDREAID
                                    WHERE DATAASSINA >= '2023-07-01'
                                    AND F.LAUDOASSOK = 'T'
                                    AND M.CONFIGURAVEL5 IS NULL) AS D";

    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    echo json_encode($laudos);
    die();
?>