<?php
    $path = "C:/imagens_laudos/";
    $diretorio = dir($path);

    $imagick = new Imagick();
    $imagick->setOption("PDF:coder", 'gs');
    $imagick->setResolution(300,300);

    $n = 0;

    while($arquivo = $diretorio -> read()){   
        if (str_contains($arquivo, ".pdf") && $n < 1) {
            if(file_exists($path.$arquivo)){
                $imagick->readImage($path.$arquivo); 
                $nome = str_replace("pdf", "png", $arquivo);
                if($imagick->writeImages($path.$nome, false)){
                    rename($path.$arquivo, $path.'\\pdfs\\'.$arquivo);
                };
                $n++;
            };            
        };
    }
?>