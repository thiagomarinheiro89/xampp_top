<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Sao_Paulo');

function conecta_banco(){

    require('database.php');

      try {
    $conn = new PDO('mysql:host='.$host.';dbname='.$banco, $user, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8mb4");
    return $conn;
  } catch(PDOException $e) {
      die('ERROR: Não foi possível conectar ao banco de dados - ' . $e->getMessage());
  }
}

function roda_query($query, $dados){
  $conn = conecta_banco();

  if(!is_array($dados)){
    $dados = array($dados);
  }

  try {
    $db = $conn->prepare($query);
    $execucao = $db->execute($dados);
    $id = $conn->lastInsertId();

    return array('status' => $execucao, 'id'=>$id);
  } catch (PDOException $e) {
    return array('status' => false, 'id'=>0, $e->getMessage());
  }
  
}

function gera_log($usuario, $acao, $mensagem){
  $query = "INSERT INTO log_sistema (id_usuario, acao, mensagem, data) values (?, ?, ?, ?)";
  $dados = array($usuario, $acao, $mensagem, date('y-m-d H:i:s'));
  roda_query($query, $dados);
}

function retorno($status, $msg, $dados=array()){
  $retorno['status'] = $status;
  $retorno['msg'] = $msg;
  $retorno['registros'] = count($dados);
  $retorno['dados'] = $dados;

  echo json_encode($retorno);
  die();
}
?>
