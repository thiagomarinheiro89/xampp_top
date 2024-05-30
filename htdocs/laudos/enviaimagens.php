<?php
$path = 'C:\\imagens_laudos\\';
$diretorio = dir($path);

$n = 0;
$limite = isset($_GET['limite']) ? $_GET['limite'] : 30;

while($arquivo = $diretorio -> read()){
  $arquivo_ex = array('.','..');
  
  if (!in_array($arquivo, $arquivo_ex) 
      && is_numeric(strpos($arquivo, '.'))
      && !strpos($arquivo, '.lnk') 
      && !strpos($arquivo, '.pdf')
      && $n < $limite) {
    $file = file_get_contents($path.$arquivo);
    $file = $file;
  
    $post = array('file'=>$file);

    echo $arquivo.'<br>';
    echo 'https://nautasoftware.com.br/imn/api/imagem.php?arquivo='.$arquivo.'<hr>';    
    $ch = curl_init('https://nautasoftware.com.br/imn/api/imagem.php?arquivo='.$arquivo);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  
    // execute!
    $response = curl_exec($ch);
    
    var_dump(curl_error($ch));

    // close the connection, release resources used
    curl_close($ch);
  
    // do anything you want with your response
    if ($response == $arquivo){
      echo $arquivo.' enviado <br>';
      rename($path.$arquivo, $path.'\\enviadas\\'.$arquivo);  
      $n++;
    } else {
      var_dump($response);
    }    
  }
}
$diretorio -> close();
?>
