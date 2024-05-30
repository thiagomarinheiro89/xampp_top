var timeLaudo =  setTimeout(function(){
    roda_tarefa(4)
    }, 1000);

    var timePaciente =  setTimeout(function(){
        roda_tarefa(3)
}, 200000);

var timeMedico =  setTimeout(function(){
    roda_tarefa(1)
}, 400000);

var timeImagens =  setTimeout(function(){
    roda_tarefa(5)
}, 600000);

var timeCanc =  setTimeout(function(){
    roda_tarefa(6)
}, 800000);

var timeWhats =  setTimeout(function(){
    roda_tarefa(7)
}, 1000000);

var timeSus =  setTimeout(function(){
    roda_tarefa(8)
}, 1200000);

var timeIntegra =  setTimeout(function(){
    roda_tarefa(9)
}, 1300000);

var timePendencia =  setTimeout(function(){
    roda_tarefa(10)
}, 1500000);


async function roda_tarefa(n){
    $("#data_"+n).text(new Date);
    $("#status_"+n).text("Executando...");

    switch (n) {
        case 1:
            atualiza_medicos();    
        break;
        case 2:
            atualiza_procedimentos();    
        break;
        case 3:
            atualiza_pacientes();    
        break;
        case 4:
            atualiza_laudos();    
        break;
        case 5:
            atualiza_imagens();    
        case 6:
            atualiza_cancelados();    
        break;
        case 7:
            atualiza_whats();    
        break;
        case 8:
            envia_sus();    
        break;
        case 9:
            integra_nauta();    
        break;
        case 10:
            pendencias();    
        break;
        default:
            break;
    }
}

async function pendencias(){
    clearTimeout(timePendencia);

    await $.get("control/listaPendentes.php", async function(data){
        body= {"json":data}

        await $.post("https://nautasoftware.com.br/imn/api/pedentes.php", body, function(data){
            console.log(data);
        });

        $("#status_10").text("Aguardando"); 
    });

    var timePendencia =  setTimeout(function(){
        roda_tarefa(10)
    }, 200000);

}

async function integra_nauta(){
    clearTimeout(timeIntegra)

    await $.get("control/integraNauta.php", async function(data){
        fila = JSON.parse(data);

        for (let i = 0; i < fila.length; i++) {
            body = {
                    "PROCID" : fila[i]['PROCEDIMENTO'],
                    "ENTREGADATA" : fila[i]['ENTREGADATA'],
                    "FATURAID" : fila[i]['FATURAID'],
                    "MEDREAID" : fila[i]['MEDREAID'],
                    "NOME" : fila[i]['NOME'],
                    "PACIENTEID" : fila[i]['PACIENTEID'],
                    "DATA":fila[i]['DATA']
                   }
            
            await $.post("https://nautasoftware.com.br/imn/api/integraLaudo.php", body,async function(data){
                   retorno = JSON.parse(data);
                   let  faturaid = retorno.dados[0];
                   if (retorno.status){
                        await $.get("control/finalizaIntegracao.php?id="+faturaid, function(){});
                   }
            });
            
        }

        $("#status_9").text("Aguardando"); 
    });

    var timeIntegra =  setTimeout(function(){
        roda_tarefa(9)
    }, 300000);

    

}

async function envia_sus(){
    clearTimeout(timeSus)

    await $.get("control/listaSus.php", async function(data){
        mensagens = JSON.parse(data);

        for (let i = 0; i < 1; i++) {
            body = {
                number : mensagens[i]['ddd']+mensagens[i]['numero'],
                message : mensagens[i]['mensagem']
            }

            await localStorage.setItem("idSus", mensagens[i]['id_mensagem']);

            
            await $.post("http://localhost:8000/send-message", body, async function(data){
                console.log(data);
                await $.post("control/atualizasus.php", {id :   mensagens[i]['id_mensagem'], retorno: data['msg']}, function(data){
                    console.log(data);
                });     
            });
        }
    });

    var timeSus =  setTimeout(function(){
        roda_tarefa(8)
    }, 120000);
    $("#status_8").text("Aguardando"); 

}

async function atualiza_imagens(){
    clearTimeout(timeImagens)
    await $.get('enviaimagens.php', function(data){
        console.log(data);
    });

    timeImagens =  setTimeout(function(){
            roda_tarefa(5)
    }, 300000);

    $("#status_5").text("Aguardando");  
}   

async function atualiza_medicos(){
    clearTimeout(timeMedico)

    await $.get('control/listaMedicos.php', async function(data){
        medicos = JSON.parse(data);

        for (let i = 0; i < medicos.length; i++) {
            body = {
                    "id": medicos[i]['MEDICOID'],
                    "nome": medicos[i]['NOME'],
                    "documento": medicos[i]['documento'],
                    "titulo": medicos[i]['titulo']
                   }
                   
            link = 'https://nautasoftware.com.br/imn/api/profissionais.php';
            
                await $.ajax({
                    type:"post",
                    url: link,
                    crossDomain: true,
                    data: body,
                   success: async function(data) {
                        await $.get("control/atualizamedico.php?id="+medicos[i]['MEDICOID'], function(){});
                    }, error: function(err) {
                      console.log(err)
                      setTimeout(function(){
                        window.location.reload();
                    }, 5000);
                    }
                  });
        }

        timeMedico =  setTimeout(function(){
            roda_tarefa(1)
        }, 300000);

        $("#status_1").text("Aguardando");        
    });
}

async function atualiza_whats(){
    clearTimeout(timeWhats)

    link = 'https://nautasoftware.com.br/imn/api/whats.php';
            
    await $.ajax({
        type:"get",
        url: link,
        crossDomain: true,
        success: async function(data) {
            retorno = JSON.parse(data);
            for (let i = 0; i < retorno['registros']; i++) {
                await $.post('control/mensagensWhats.php', retorno['dados'][i], function(){
                });                
            }

            $.get("enviamensagem.php", async function(data){
                retorno = JSON.parse(data);

                for (let i = 0; i < 1; i++) {
                    body = {
                            number: retorno[i]['numero'],
                            message: "Olá "+retorno[i]['nome']+"\n\n"+
                                     "Informamos que o resultado do seu procedimento realizado no Instituto de Medicina Nuclear: "+
                                     retorno[i]['procedimento']+" já esta disponível em nosso site \n"+
                                    "www.imncuiaba.com.br \n\n"+
                                    "Informe o usuário e senha informado no protocolo de resultado para ter acesso ao mesmo"
                            }

                    localStorage.setItem("fatura", retorno[i]['faturaId'])
                    await $.post("http://localhost:8000/send-message", body, function(data){
                        body = {
                                "fatura":localStorage.getItem("fatura"),
                                "retorno":data
                               }
                        $.post("control/atualizamsg.php", body, function(){});
                    });
                }

            });
            
        }, error: function(err) {
            console.log(err);
            setTimeout(function(){
                window.location.reload();
            }, 3000);
        }
        });

    timeWhats =  setTimeout(function(){
        roda_tarefa(7)
    }, 60000);

    $("#status_7").text("Aguardando");       
}

async function atualiza_cancelados(){
    clearTimeout(timeCanc)

    link = 'https://nautasoftware.com.br/imn/api/listaCancelamentos.php';
            
    await $.ajax({
        type:"get",
        url: link,
        crossDomain: true,
        success: async function(data) {
            retorno_c = JSON.parse(data);
            
            for (let i = 0; i < retorno_c['registros']; i++) {
                await $.get('control/cancelaLaudo.php?id='+retorno_c['dados'][i]['faturaId']);            
            }
            
        }, error: function(err) {
            console.log(err);
            setTimeout(function(){
                window.location.reload();
            }, 5000);
        }
        });

    timeCanc =  setTimeout(function(){
        roda_tarefa(6)
    }, 10000);

    $("#status_6").text("Aguardando");       
}


async function atualiza_pacientes(){
    clearTimeout(timePaciente)
    await $.get('control/listapacientes.php', async function(data){
        pacientes = JSON.parse(data);

        for (let i = 0; i < pacientes.length; i++) {
            body = {
                    "id": pacientes[i]['PACIENTEID'],
                    "nome": pacientes[i]['NOME'],
                    "cpf": pacientes[i]['DOCUMENTO'],
                    "email": pacientes[i]['EMAIL'],
                    "data_nasc": pacientes[i]['DATANASC'],
                    "numero_celular": pacientes[i]['TELEFONE']
                   }
                   
            link = 'https://nautasoftware.com.br/imn/api/clientes.php';
            
                await $.ajax({
                    type:"post",
                    url: link,
                    crossDomain: true,
                    data: body,
                   success: async function(data) {
                        await $.get("control/atualizapaciente.php?id="+pacientes[i]['PACIENTEID'], function(){});
                    }, error: function(err) {
                      console.log(err)
                      setTimeout(function(){
                        window.location.reload();
                    }, 5000);
                    }
                  });
        }
        $("#status_3").text("Aguardando"); 
        timePaciente =  setTimeout(function(){
            roda_tarefa(3)
        }, 300000);
               
    });
}

async function atualiza_procedimentos(){
    await $.get('control/listaProcedimentos.php', async function(data){
        procedimentos = JSON.parse(data);

        for (let i = 0; i < procedimentos.length; i++) {
            body = {
                    "id": procedimentos[i]['PROCID'],
                    "nome": procedimentos[i]['DESCRICAO'],
                    "sigla": procedimentos[i]['MNEMONICO']
                    }
                   
            link = 'https://nautasoftware.com.br/imn/api/procedimentos.php';
            
                await $.ajax({
                    type:"post",
                    url: link,
                    crossDomain: true,
                    data: body,
                   success: async function(data) {
                    }, error: function(err) {
                      console.log(err)
                      setTimeout(function(){
                        window.location.reload();
                    }, 5000);
                    }
                  });
        }
        $("#status_2").text("Aguardando");        
    });
}

async function atualiza_laudos(){
    clearTimeout(timeLaudo)

    $.get("control/listaLaudos.php", async function(data){
        laudos = JSON.parse(data);

        for (let i = 0; i < laudos.length; i++) {
            body = {
                        "faturaid": laudos[i]['FATURAID'],
                        "requisicaoid": laudos[i]['REQUISICAOID'],
                        "pacienteid": laudos[i]['PACIENTEID'],
                        "medicoid": laudos[i]['MEDSOLID'],
                        "medicoass": laudos[i]['MEDID'],
                        "procedimentoid": laudos[i]['PROCID'],
                        "laudo": laudos[i]['LAUDO'],
                        "data": laudos[i]['DATA'],
                        "convenio": laudos[i]['CONVENIO'],
                        "unidadeId":laudos[i]['UNIDADEID']
                    }
                   
            link = 'https://nautasoftware.com.br/imn/api/laudos.php';
                
                await $.ajax({
                    type:"post",
                    url: link,
                    crossDomain: true,
                    data: body,
                    success: async function(data) {
                        $.get("control/atualizalaudo.php?id="+laudos[i]['FATURAID'], function(data){});
                    }, error: function(err) {
                        setTimeout(function(){
                            window.location.reload();
                        }, 5000);
                    }
                  });
        }
        $("#status_4").text("Aguardando"); 
        timeLaudo =  setTimeout(function(){
            roda_tarefa(4)
        }, 300000);
    });
}