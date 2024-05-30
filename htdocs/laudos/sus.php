<?php
    include("control/config.php");
    $con = mysqli_connect("localhost", "root", "", "nautazap");
   
    /* Primeiro Contato */
    $livro = 26;
    $sql = "SELECT id_protocolo FROM msgsus where livro = $livro";
    $bd = mysqli_query($con, $sql) or die(mysqli_error($con));

    $protocolo = array();

    while ($row = mysqli_fetch_assoc($bd)) {
        $protocolo[] = $row['id_protocolo'];
    }

    if (!empty($protocolo)) {
        $where = " AND ac.protocolo not in (".implode(",", $protocolo).")";
    } else {
        $where = '';
    }

    $sql = "SELECT 
                ac.Protocolo,
                ac.Nome,
                ac.ddd,
                ac.telefone,
                ac.Agenda_data,
                ac.Agenda_hora,
                ac.Unidade,
                ac.ENDERECO,
                ac.LIVROID
            FROM AGENDA_CONFIRMA ac
            where ac.LIVROID in ($livro) 
            $where

            union all

            SELECT 
                ac.Protocolo,
                ac.Nome,
                pc.ddd,
                pc.telefone,
                ac.Agenda_data,
                ac.Agenda_hora,
                ac.Unidade,
                ac.ENDERECO,
                ac.LIVROID
            FROM AGENDA_CONFIRMA ac
            left join PACIENTETELEFONES pc on pc.PACIENTEID = ac.CodPaciente
            where ac.LIVROID in ($livro) and isnull(pc.TIPOTELEFONEID,1) = 1
            and pc.DDD is not null
            $where

            order by Protocolo";
            
    $query      = $pdo->query($sql);
    $pacientes   = $query->fetchAll();

    $n = 0;

    foreach ($pacientes as $paciente) {
        $textos = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','_',' '];


        $dd = str_replace("0", "", str_replace($textos, "", $paciente['ddd']));
        $numero = str_replace($textos, "", $paciente['telefone']);
        $protocolo = $paciente['Protocolo'];  
        $mensagem = "Prezado(a) ".$paciente['Nome']."\n\n Temos um Exame autorizado pelo SUS liberado para agendamento. \n\n Entrar em contato com o INSTITUTO DE MEDICINA NUCLEAR \n\n FONE: (65) 4009-2880 \n\n WHATS: (65) 99936-5562 \n\n www.imncuiaba.com.br/st/unidades-imn \n\n *OBS.: Necessário apresentação do pedido original no dia do Exame.*";
        $livro = $paciente['LIVROID'];  

        $insert = "INSERT INTO msgsus (id_protocolo, ddd, numero, mensagem, livro) values ('$protocolo', '$dd', '$numero', '$mensagem', $livro)";
        $bd = mysqli_query($con, $insert) or die(mysqli_error($con));
        $n++;
    }

    /* Segundo Contato */
    $livro = 30;
    $sql = "SELECT id_protocolo FROM msgsus where livro = $livro";
    $bd = mysqli_query($con, $sql) or die(mysqli_error($con));

    $protocolo = array();

    while ($row = mysqli_fetch_assoc($bd)) {
        $protocolo[] = $row['id_protocolo'];
    }

    if (!empty($protocolo)) {
        $where = " AND ac.protocolo not in (".implode(",", $protocolo).")";
    } else {
        $where = '';
    }

    $sql = "SELECT 
                ac.Protocolo,
                ac.Nome,
                ac.ddd,
                ac.telefone,
                ac.Agenda_data,
                ac.Agenda_hora,
                ac.Unidade,
                ac.ENDERECO,
                ac.LIVROID
            FROM AGENDA_CONFIRMA ac
            where ac.LIVROID in ($livro) 
            $where

            union all

            SELECT 
                ac.Protocolo,
                ac.Nome,
                pc.ddd,
                pc.telefone,
                ac.Agenda_data,
                ac.Agenda_hora,
                ac.Unidade,
                ac.ENDERECO,
                ac.LIVROID
            FROM AGENDA_CONFIRMA ac
            left join PACIENTETELEFONES pc on pc.PACIENTEID = ac.CodPaciente
            where ac.LIVROID in ($livro) and isnull(pc.TIPOTELEFONEID,1) = 1
            and pc.DDD is not null
            $where

            order by Protocolo";
            
    $query      = $pdo->query($sql);
    $pacientes   = $query->fetchAll();

    foreach ($pacientes as $paciente) {
        $textos = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','_',' '];


        $dd = str_replace("0", "", str_replace($textos, "", $paciente['ddd']));
        $numero = str_replace($textos, "", $paciente['telefone']);
        $protocolo = $paciente['Protocolo'];  
        $mensagem = "Prezado(a) ".$paciente['Nome']."\n\n Temos um Exame autorizado pelo SUS liberado para agendamento. \n\n Entrar em contato com o INSTITUTO DE MEDICINA NUCLEAR \n\n FONE: (65) 4009-2880 \n\n WHATS: (65) 99936-5562 \n\n www.imncuiaba.com.br/st/unidades-imn \n\n *OBS.: Necessário apresentação do pedido original no dia do Exame.*";
        $livro = $paciente['LIVROID'];  

        $insert = "INSERT INTO msgsus (id_protocolo, ddd, numero, mensagem, livro) values ('$protocolo', '$dd', '$numero', '$mensagem', $livro)";
        $bd = mysqli_query($con, $insert) or die(mysqli_error($con));
        $n++;
    }

    /* Terceiro Contato */
    $livro = 31;
    $sql = "SELECT id_protocolo FROM msgsus where livro = $livro";
    $bd = mysqli_query($con, $sql) or die(mysqli_error($con));

    $protocolo = array();

    while ($row = mysqli_fetch_assoc($bd)) {
        $protocolo[] = $row['id_protocolo'];
    }

    if (!empty($protocolo)) {
        $where = " AND ac.protocolo not in (".implode(",", $protocolo).")";
    } else {
        $where = '';
    }

    $sql = "SELECT 
                ac.Protocolo,
                ac.Nome,
                ac.ddd,
                ac.telefone,
                ac.Agenda_data,
                ac.Agenda_hora,
                ac.Unidade,
                ac.ENDERECO,
                ac.LIVROID
            FROM AGENDA_CONFIRMA ac
            where ac.LIVROID in ($livro) 
            $where

            union all

            SELECT 
                ac.Protocolo,
                ac.Nome,
                pc.ddd,
                pc.telefone,
                ac.Agenda_data,
                ac.Agenda_hora,
                ac.Unidade,
                ac.ENDERECO,
                ac.LIVROID
            FROM AGENDA_CONFIRMA ac
            left join PACIENTETELEFONES pc on pc.PACIENTEID = ac.CodPaciente
            where ac.LIVROID in ($livro) and isnull(pc.TIPOTELEFONEID,1) = 1
            and pc.DDD is not null
            $where

            order by Protocolo";
            
    $query      = $pdo->query($sql);
    $pacientes   = $query->fetchAll();

    foreach ($pacientes as $paciente) {
        $textos = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','_',' '];


        $dd = str_replace("0", "", str_replace($textos, "", $paciente['ddd']));
        $numero = str_replace($textos, "", $paciente['telefone']);
        $protocolo = $paciente['Protocolo'];  
        $mensagem = "Prezado(a) ".$paciente['Nome']."\n\n Temos um Exame autorizado pelo SUS liberado para agendamento. \n\n Entrar em contato com o INSTITUTO DE MEDICINA NUCLEAR \n\n FONE: (65) 4009-2880 \n\n WHATS: (65) 99936-5562 \n\n www.imncuiaba.com.br/st/unidades-imn \n\n *OBS.: Necessário apresentação do pedido original no dia do Exame.*";
        $livro = $paciente['LIVROID'];  

        $insert = "INSERT INTO msgsus (id_protocolo, ddd, numero, mensagem, livro) values ('$protocolo', '$dd', '$numero', '$mensagem', $livro)";
        $bd = mysqli_query($con, $insert) or die(mysqli_error($con));
        $n++;
    }

    echo $n."- Mensagens adicionadas na fila";
?>