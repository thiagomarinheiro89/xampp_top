<?php
$path = 'C:\\imagens_laudos\\';
$diretorio = dir($path);

$arquivo = $_GET['arquivo'];
$file = $path.$arquivo;

rename($file, $path.'\\enviadas\\'.$arquivo);
?>
