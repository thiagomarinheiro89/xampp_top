
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>NautaAdmin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script src='js/tarefas.js?<?php echo time(); ?>'></script>
    </head>
    <body>
    <h1 class='text-danger text-cente'><center>Não Fechar essa página !!!</center></h1>
    <br>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Tarefa</th>
                <th>Ultima Realização</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Importa Médicos</td>
                <td><span id='data_1'></span>
                <td><span id='status_1'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(1)'>Rodar</button>
            </tr>
            <tr class='d-none'>
                <td>Importa Procedimentos</td>
                <td><span id='data_2'></span>
                <td><span id='status_2'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(2)'>Rodar</button>
            </tr>
            <tr>
                <td>Importa Pacientes</td>
                <td><span id='data_3'></span>
                <td><span id='status_3'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(3)'>Rodar</button>
            </tr>
            <tr>
                <td>Importa Laudos</td>
                <td><span id='data_4'></span>
                <td><span id='status_4'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(4)'>Rodar</button>
            </tr>
            <tr>
                <td>Importa Imagens</td>
                <td><span id='data_5'></span>
                <td><span id='status_5'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(5)'>Rodar</button>
            </tr>
            <tr>
                <td>Cancelamentoes</td>
                <td><span id='data_6'></span>
                <td><span id='status_6'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(6)'>Rodar</button>
            </tr>
            <tr>
                <td>Mensagens</td>
                <td><span id='data_7'></span>
                <td><span id='status_7'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(7)'>Rodar</button>
            </tr>
            <tr>
                <td>Mensagem Sus Primeiro Contato</td>
                <td><span id='data_8'></span>
                <td><span id='status_8'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(8)'>Rodar</button>
            </tr>
            <tr>
                <td>Integração Gestor de Laudos</td>
                <td><span id='data_9'></span>
                <td><span id='status_9'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(9)'>Rodar</button>
            </tr>
            <tr>
                <td>Pendencias</td>
                <td><span id='data_10'></span>
                <td><span id='status_10'></span>
                <td><button class='btn btn-primary' onclick='roda_tarefa(10)'>Rodar</button>
            </tr>
        </tbody>
    </table>