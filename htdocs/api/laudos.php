<?php
header("Access-Control-Allow-Origin: *");

    $auth = 0;
    $id_user = 15;

    include("config.php");

    if (isset($_POST) && !empty($_POST)) {
        $sql = "insert into laudos (faturaId, requisicaoId, pacienteId, medicoId, medAssinatura, procedimentoId, laudo, data, convenio, unidadeId) VALUES
                (?,?,?,?,?,?,?,?,?,?)";
        $campos = array(
                          $_POST['faturaid'],
                          $_POST['requisicaoid'],
                          $_POST['pacienteid'],
                          $_POST['medicoid'],
                          $_POST['medicoass'],
                          $_POST['procedimentoid'],
                          $_POST['laudo'],
                          $_POST['data'],
                          $_POST['convenio'],
                          $_POST['unidadeId']
                        );
        $retorno = roda_query($sql, $campos);

        if ($retorno['status']) {
            gera_log($id_user, "API", "Criou o laudo ".$_POST['requisicaoid']);
            retorno(true, "Laudo adicionado com sucesso!");
        } else {
            retorno(false, "não foi possivel adicionar o laudo!", $retorno);
        }
    } else {
        retorno(false, "Funcionalidade não implementada");
    }

?>
