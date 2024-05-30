<?php
    include("control/config.php");

    $sql = "select 
                    f.UNIDADEID,
                    f.FATURAID,
                    f.PACIENTEID,
                    f.PROCID  
            from FATURA f
            where f.FORMAENTREGAID <> 15
                and f.DATA > '2023-12-31'
                and isnull(f.imagem_arquivada, 0) = 0";
    
    $query      = $pdo->query($sql);
    $laudos   = $query->fetchAll();

    foreach ($laudos as $laudo) {
        $path = 'C:\\imagens_laudos\\enviadas\\';
        $diretorio = dir($path);

        include("proc.php");

        echo $laudo['PACIENTEID']."_".$siglas[$laudo['PROCID']]."\n";

        $erro = 0;
        $n = 0;

        while($arquivo = $diretorio -> read()){
            if (str_contains($arquivo, $laudo['PACIENTEID']) && str_contains($arquivo, $siglas[$laudo['PROCID']]) && !str_contains($arquivo, ".png")) {
                if(!rename("C:\\imagens_laudos\\enviadas\\".$arquivo, "C:\\imagens_laudos\\cuiaba_color\\".$laudo['UNIDADEID']."_".$arquivo)){
                    $erro = 1;
                } else {
                    $n++;
                };
            }
        }

        if ($erro == 0 && $n > 0) {
            $sql = "UPDATE FATURA set imagem_arquivada = 1 where FATURAID = ".$laudo['FATURAID'];
            $query      = $pdo->query($sql);
        }
    }
?>