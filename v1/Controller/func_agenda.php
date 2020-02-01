<?php
include_once 'Controller_agenda.php';
include_once "Controller_notificacao.php";
include_once 'Controller_servicosAgenda.php';
include_once 'Controller_usuario.php';
include_once 'Controller_salao.php';
include_once 'Controller_funcionarios.php';
include_once "enviaNotfication.php";
include_once 'Controller_servicosSalao.php';

class Agendas
{

    public function salvar($request)
    {
        $idSalao = $request->getParam('idSalao');
        $idFuncionario = $request->getParam('idFuncionario');
        $idUsuario = $request->getParam('idUsuario');
        $data = $request->getParam('data');
        $horaIni = $request->getParam('horaIni');
        $horaFim = $request->getParam('horaFim');
        $idsServicos = $request->getParam('idServicos'); //00,00

        $status = 1; //0=cancelado 1=aguardando 2=finalizado
        if ($idSalao != "" && $idFuncionario != "" && $idUsuario != "" &&
            $data != "" && $horaIni != "" && $horaFim != "" && $idsServicos != "") {

            $idsServicos = explode(",", $idsServicos);
            $agenda = new Agenda();
            $agenda->setIdSalao($idSalao);
            $agenda->setIdFuncionario($idFuncionario);
            $agenda->setIdUsuario($idUsuario);
            $agenda->setData($data);
            $agenda->setHoraIni($horaIni);
            $agenda->setHoraFim($horaFim);
            $agenda->setStatus($status);
            $retornoAgenda = $agenda->sav_agenda();
            if ($retornoAgenda) {
                $idAgendado = $retornoAgenda->lastInsertId();

                $values = [];
                for ($x = 0; $x < sizeof($idsServicos); $x++) {
                    array_push($values, "(" . $idAgendado . "," . $idsServicos[$x] . ")");
                }
                $valores = implode(",", $values);

                $servicoAgenda = new ServicosAgenda();
                $retornoServicoAgenda = $servicoAgenda->sav_servicoAgenda($valores);

                if ($retornoServicoAgenda) {

                    $Usuario = new Usuario();
                    $Usuario->setIdUsuario($idUsuario);
                    $retornoUsuario = $Usuario->get_usuario_Id();
                    if (sizeof($retornoUsuario) > 0) {
                        $idLoginUsuario = $retornoUsuario[0]->idLogin;
                        $nomeUsuario = $retornoUsuario[0]->nome;
                        $telefoneUsuario = $retornoUsuario[0]->telefone;
                        $topicoUsuario = $retornoUsuario[0]->topicoNotificacao;
                    }

                    $nomeSalao = "...";

                    $Salao = new Salao();
                    $Salao->setIdSalao($idSalao);
                    $retornoSalao = $Salao->get_salao_idSalao();
                    if (sizeof($retornoSalao) > 0) {
                        $nomeSalao = $retornoSalao[0]->nome;
                    }

                    $funcionario = new Funcionario();
                    $funcionario->setIdFuncionario($idFuncionario);
                    $retornoFuncionario = $funcionario->consult_funcionarios_idFuncionario();
                    if (sizeof($retornoFuncionario) > 0) {
                        $idUsuarioFunc = $retornoFuncionario[0]->idUsuario;
                        $UsuarioFunc = new Usuario();
                        $UsuarioFunc->setIdUsuario($idUsuarioFunc);
                        $retornoUsuarioFunc = $UsuarioFunc->get_usuario_Id();
                        if (sizeof($retornoUsuarioFunc) > 0) {
                            $idLoginUsuarioFuncionario = $retornoUsuarioFunc[0]->idLogin;
                            $nomeFuncionario = $retornoUsuarioFunc[0]->nome;
                            $topicoFuncionario = $retornoUsuarioFunc[0]->topicoNotificacao;
                            $telefoneFuncionario = $retornoUsuarioFunc[0]->telefone;
                        }
                    }

                    $enviaNotification = new enviaNotification();
                    $tz_object = new DateTimeZone('Brazil/East');
                    $datetime = new DateTime();
                    $datetime->setTimezone($tz_object);
                    $dataSer = $datetime->format('H:m d-m-Y');
                    $dataAux = explode("-", $data);
                    $dataServ = $dataAux[2] . "/" . $dataAux[1] . "/" . $dataAux[0];
                    // notificacao para funcionario-------------
                    $titulo = "Novo Agendamento !!";
                    $menssagem = $nomeUsuario . " realizou o agendamento para o dia "
                        . $dataServ . " das " . $horaIni . " ás " . $horaFim
                        . "\n telefone para contato: " . $telefoneUsuario;
                    $enviaNotification->EnviarNotificacao($titulo, $menssagem, $nomeSalao, $dataSer, $topicoFuncionario);

                    $newNotificacaoFunc = new Notificacao();
                    $newNotificacaoFunc->setIdUsuario($idLoginUsuarioFuncionario);
                    $newNotificacaoFunc->setTitulo($titulo);
                    $newNotificacaoFunc->setCorpo($menssagem);
                    $newNotificacaoFunc->setData($datetime->format('H:m'));
                    $newNotificacaoFunc->setVisualizado("0");
                    $newNotificacaoFunc->setNomeSalao($nomeSalao);
                    $retornoNewNotificacaoFunc = $newNotificacaoFunc->sav_notificacao();

                    // notificacao para o cliente---------------
                    $enviaNotification2 = new enviaNotification();
                    $titulo = "Novo Agendamento !!";
                    $menssagem = "Você realizou o agendamento para o dia " . $dataServ . " das " . $horaIni . " ás " . $horaFim
                        . "\n com o funcionario " . $nomeFuncionario . " - telefone para contato: " . $telefoneFuncionario;
                    $enviaNotification2->EnviarNotificacao($titulo, $menssagem, $nomeSalao, $dataSer, $topicoUsuario);

                    $newNotificacaoFunc = new Notificacao();
                    $newNotificacaoFunc->setIdUsuario($idLoginUsuario);
                    $newNotificacaoFunc->setTitulo($titulo);
                    $newNotificacaoFunc->setCorpo($menssagem);
                    $newNotificacaoFunc->setData($datetime->format('H:m'));
                    $newNotificacaoFunc->setVisualizado("0");
                    $newNotificacaoFunc->setNomeSalao($nomeSalao);
                    $retornoNewNotificacaoFunc = $newNotificacaoFunc->sav_notificacao();

                    header('HTTP/1.1 204 01');
                    exit;
                } else {
                    header('HTTP/1.1 400 003');
                    exit;
                    //excluir o agendamento caso de esse erro
                }
            } else {
                header('HTTP/1.1 400 03');
                exit;
            }
        } else {
            header('HTTP/1.1 400 02');
            exit;
        }
    }

    public function alterarStatus($request)
    {

        $idAgenda = $request->getAttribute('idAgenda');
        $status = $request->getAttribute('status');
        if ($idAgenda != "" && $status != "") {

            $agenda = new Agenda();
            $agenda->setIdAgenda($idAgenda);
            $retornoAgenda = $agenda->consult_id_agenda();
            if (sizeof($retornoAgenda) > 0) {
                $data = $retornoAgenda[0]->data;
                $horaIni = $retornoAgenda[0]->horaIni;
                $idUsuarioAgenda = $retornoAgenda[0]->idUsuario;

                $funcionario = new Funcionario();
                $funcionario->setIdFuncionario($retornoAgenda[0]->idFuncionario);
                $retornoFuncionario = $funcionario->consult_funcionarios_idFuncionario();

                if (sizeof($retornoFuncionario) > 0) {
                    $idUsuario = $retornoFuncionario[0]->idUsuario;
                    $Usuario = new Usuario();
                    $Usuario->setIdUsuario($idUsuario);
                    $retornoUsuario = $Usuario->get_usuario_Id();
                    if (sizeof($retornoUsuario) > 0) {
                        //$nomeFuncionario = $retornoUsuario[0]->nome;
                        $idLoginUsuarioFuncionario = $retornoUsuario[0]->idLogin;
                        $topicoFuncionario = $retornoUsuario[0]->topicoNotificacao;
                        //$telefoneFuncionario = $retornoUsuario[0]->telefone;
                    }
                }

                //$Usuario = new Usuario();
                $Usuario->setIdUsuario($idUsuarioAgenda);
                $retornoUsuario = $Usuario->get_usuario_Id();
                if (sizeof($retornoUsuario) > 0) {
                    $nomeCliente = $retornoUsuario[0]->nome;
                    $telefoneCliente = $retornoUsuario[0]->telefone;
                }
            }

            $agenda = new Agenda();
            $agenda->setIdAgenda($idAgenda);
            $agenda->setStatus($status);
            $retornoAgenda = $agenda->alt_status();
            if ($retornoAgenda) {

                //se for usuario anonimo exclui o cadastro
                $Usuario2 = new Usuario();
                $Usuario2->setIdUsuario($idUsuarioAgenda);
                $retornoUsuario2 = $Usuario2->get_usuario_Id();
                if (sizeof($retornoUsuario2) > 0) {

                    $top = $retornoUsuario2[0]->topicoNotificacao;

                    if ($top == "0x00") {
                        $Usuario3 = new Usuario();
                        $Usuario3->setIdUsuario($idUsuarioAgenda);
                        $retornoUsuario3 = $Usuario3->exc_usuario_anonimo();
                    }

                }

                if ($status == "0") {

                    $enviaNotification = new enviaNotification();
                    $tz_object = new DateTimeZone('Brazil/East');
                    $datetime = new DateTime();
                    $datetime->setTimezone($tz_object);
                    $dataSer = $datetime->format('H:m d-m-Y');
                    $dataAux = explode("-", $data);
                    $dataServ = $dataAux[2] . "/" . $dataAux[1] . "/" . $dataAux[0];
                    // notificacao para funcionario-------------
                    $titulo = "Atenção. Agendamento Cancelado !!";
                    $menssagem = "O cliente " . $nomeCliente . " cancelou o agendamento do dia "
                        . $dataServ . " ás " . $horaIni . "\n telefone para contato: " . $telefoneCliente;
                    $nomeSalao = "...";
                    $enviaNotification->EnviarNotificacao($titulo, $menssagem, $nomeSalao, $dataSer, $topicoFuncionario);

                    $newNotificacaoFunc = new Notificacao();
                    $newNotificacaoFunc->setIdUsuario($idLoginUsuarioFuncionario);
                    $newNotificacaoFunc->setTitulo($titulo);
                    $newNotificacaoFunc->setCorpo($menssagem);
                    $newNotificacaoFunc->setData($datetime->format('H:m'));
                    $newNotificacaoFunc->setVisualizado("0");
                    $newNotificacaoFunc->setNomeSalao($nomeSalao);
                    $retornoNewNotificacaoFunc = $newNotificacaoFunc->sav_notificacao();

                }
                header('HTTP/1.1 204 01');
                exit;
            } else {
                header('HTTP/1.1 400 04');
                exit;
            }
        } else {
            header('HTTP/1.1 400 02');
            exit;
        }
    }

    public function excluirStatus($request)
    {

        $idAgenda = $request->getAttribute('idAgenda');

        if ($idAgenda != "") {
            $agenda = new Agenda();
            $agenda->setIdAgenda($idAgenda);
            $retornoAgenda = $agenda->exc_agenda();
            if ($retornoAgenda) {
                header('HTTP/1.1 204 01');
                exit;
            } else {
                header('HTTP/1.1 400 05');
                exit;
            }
        } else {
            header('HTTP/1.1 400 02');
            exit;
        }
    }

/*

function deletar($request)
{
$idAgenda = $request->getAttribute('id');
$apiKey = $request->getParam('apiKey');
if($idAgenda!="" && $apiKey!="")
{
$getKey = new Login();
$getKey->setApiKey($apiKey);
$findKey = $getKey->consult_all_key();
if(sizeof($findKey) > 0)
{
$agenda = new Agenda();
$agenda->setIdAgenda($idAgenda);
$retornoAgenda = $agenda->exc_agenda();

if($retornoAgenda)
{
$resultado["result"] = "5x1"; // codigo usuario cadastrado
echo json_encode($resultado);
}
else
{
$resultado["result"] = "5x0"; // codigo erro ao cadastrar
echo json_encode($resultado);
}
}
else
{
$resultado["result"] = "5x0"; // codigo erro ao cadastrar
echo json_encode($resultado);
}
}
else
{
$resultado["result"] = "5x000"; // codigo dados incorretos
echo json_encode($resultado);
}
}

 */

    public function montarHorarios($request)
    {
        $idSalao = $request->getParam('idSalao');
        $idFuncionario = $request->getParam('idFuncionario');
        $servicos = $request->getParam('servicos');

        $tz_object = new DateTimeZone('Brazil/East');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $dataSer = $datetime->format('Y-m-d');

        $data = $request->getParam('data');

        $Salao = new Salao();
        $Salao->setIdSalao($idSalao);
        $retornoSalao = $Salao->get_salao_idSalao();
        if (sizeof($retornoSalao) > 0) {
            $funcionario = new Funcionario();
            $funcionario->setIdFuncionario($idFuncionario);
            $retornoFuncionario = $funcionario->consult_funcionarios_idFuncionario();
            if (sizeof($retornoFuncionario) > 0) {
                //se funcionario estiver de ferias não monta os horarios
                $dataFeriasIni = strtotime($retornoFuncionario[0]->feriasIni);
                $dataFeriasFim = strtotime($retornoFuncionario[0]->feriasFim);
                $horaAlmocoIni = $retornoFuncionario[0]->almocoIni;
                $horaAlmocoFim = $retornoFuncionario[0]->almocoFim;
                if (strtotime($data) >= $dataFeriasIni && strtotime($data) <= $dataFeriasFim) {
                    header('HTTP/1.1 400 08');
                    exit;
                }

                $diasemana = array('dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sab');
                $diasemana_numero = date('w', strtotime($data));

                $diaAuxE = $diasemana[$diasemana_numero] . "E";
                $diaAuxS = $diasemana[$diasemana_numero] . "S";

                $horaIni = $retornoFuncionario[0]->$diaAuxE; //hora que o salao abre no dia escolhido
                $horaFim = $retornoFuncionario[0]->$diaAuxS; //hora que o salao fecha no dia escolhido
                $tempoReserva = $retornoSalao[0]->tempoReserva; //intervalo de tempo da agenda

                $temp = explode(":", $tempoReserva);
                $hora = $temp[0];
                $min = $temp[1];
                $acres = "+" . $hora . " hour" . " +" . $min . " minutes";
                $tempoMinAgenda = $retornoSalao[0]->tempoMinAgenda; //tempo minimo para agendar
                $hora = strtotime($horaIni);
                $timestampF = strtotime($horaFim);
                $horaF = date('H:i:s', $timestampF);

                if ($horaIni != null && $horaFim != null) {
                    while ($hora <= $timestampF) {
                        $hs[] = date('H:i:s', $hora); //joga a data no vetor
                        $hora = strtotime($acres, strtotime(date('H:i:s', $hora))); //acrescenta o tempo de agendamento
                    }

                    //-------remove ultimo horario-----
                    unset($hs[sizeof($hs) - 1]);
                    $hs = array_values($hs);
                    //--------------------------------

                    if ($horaAlmocoIni != null && $horaAlmocoFim != null) {
                        $hs = $this->removeHorario($hs, $horaAlmocoIni, $horaAlmocoFim, $tempoMinAgenda);
                    }

                } else {
                    $hs = [];
                }

                $agenda = new Agenda();
                $agenda->setIdFuncionario($idFuncionario);
                $agenda->setData($data);
                $retornoAgenda = $agenda->consult_id_func();
                if (sizeof($retornoAgenda) > 0) {
                    foreach ($retornoAgenda as $key) {
                        $agendaHini = $key->horaIni;
                        $agendaHfim = $key->horaFim;
                        if ($retornoAgenda[0]->status != 0) //se estiver cancelado libera para outro user
                        {
                            $hs = $this->removeHorario($hs, $agendaHini, $agendaHfim, $tempoMinAgenda);
                        }

                    }

                    if ($dataSer == $data) {
                        $hs = $this->removeHorarioLimite($hs, $tempoMinAgenda);
                    }

                    $hs = array_values($hs);
                    $saida['intervalo'] = $tempoReserva;
                    $saida['tempoServico'] = $this->tempoTotalServ($servicos, $tempoReserva);
                    $saida['almocoIni'] = $horaAlmocoIni;
                    $saida['almocoFim'] = $horaAlmocoFim;
                    $saida['horarios'] = $hs;
                    header('HTTP/1.1 204 01');
                    echo json_encode($saida);

                } else {
                    if ($dataSer == $data) {
                        $hs = $this->removeHorarioLimite($hs, $tempoMinAgenda);
                    }
                    $hs = array_values($hs);
                    $saida['intervalo'] = $tempoReserva;
                    $saida['tempoServico'] = $this->tempoTotalServ($servicos, $tempoReserva);
                    $saida['almocoIni'] = $horaAlmocoIni;
                    $saida['almocoFim'] = $horaAlmocoFim;
                    $saida['horarios'] = $hs;
                    header('HTTP/1.1 204 00');
                    echo json_encode($saida);

                }
            } else {
                header('HTTP/1.1 400 02');
                exit;
            }
        } else {
            header('HTTP/1.1 400 01');
            //echo json_encode($saida);
            exit;
        }
    }

    public function tempoTotalServ($idsServico, $tempoReserva)
    {

        $tempoTotal = "00:00:00";
        $tempoTotalAux = "00:00:00";
        $Servico = new ServicosSalao();
        $retornoServico = $Servico->consult_servicos_idsServico($idsServico);
        if (sizeof($retornoServico) > 0) {
            for ($x = 0; $x < sizeof($retornoServico); $x++) {
                $tempoTotal = gmdate('H:i', abs(strtotime($retornoServico[$x]->tempo) + strtotime($tempoTotal)));
            }

            while ($tempoTotalAux < $tempoTotal) {
                $tempoTotalAux = gmdate('H:i', abs(strtotime($tempoTotalAux) + strtotime($tempoReserva)));
            }
        }
        return $tempoTotalAux;
    }

//---------remove os horarios limitado pelo tempo minimo------------
    public function removeHorarioLimite($arrayHorariosRemov, $tempMin)
    {
        $arrayAuxRemov = array_values($arrayHorariosRemov);
        $AuxRemov = [];
        $tz_object = new DateTimeZone('Brazil/East');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $temposer = $datetime->format('H:i');

        for ($a = 0; $a < count($arrayAuxRemov); $a++) {
            $tempoX = gmdate('H:i', abs(strtotime($arrayAuxRemov[$a]) - strtotime($tempMin))); //pega horario disponivel - tempo minimo
            if ($temposer <= $tempoX) {
                array_push($AuxRemov, $arrayAuxRemov[$a]);
            }
        }

        return $AuxRemov;
    }
//----------------------------------------------------------------

    //-------remove os horarios já agendados-----------------------
    public function removeHorario($arrayHorarios, $horI, $horF, $tempMin)
    {
        $arrayAux = $arrayHorarios;
        $auxHi = strtotime($horI);
        $auxHf = strtotime($horF);

        for ($x = 0; $x < count($arrayAux); $x++) {
            if (strtotime($arrayAux[$x]) >= $auxHi && strtotime($arrayAux[$x]) < $auxHf) {
                unset($arrayAux[$x]);
            }
        }
        return $arrayAux;
    }
    //-----------------------------------------------------------

    public function buscarAgendamento($request)
    {
        $who = $request->getAttribute('who'); // 0=usuario / 1=funcionario
        $id = $request->getAttribute('id');
        $data = $request->getAttribute('data');

        if ($who != 0 || $who != 1 && $id != "" && $data != "") {
            $agenda = new Agenda();
            $agenda->setData($data);

            if ($who == 0) {
                $agenda->setIdUsuario($id);
                $retornoAgenda = $agenda->consult_id_user();
            } else {
                $agenda->setIdFuncionario($id);
                $retornoAgenda = $agenda->consult_id_func();
            }

            if ($retornoAgenda) {

                header('HTTP/1.1 204 01');
                echo json_encode($retornoAgenda);

            } else {
                header('HTTP/1.1 400 01');
                exit;
            }
        } else {
            header('HTTP/1.1 400 02');
            exit;
        }

    }

}
