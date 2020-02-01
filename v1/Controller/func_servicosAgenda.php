<?php
include_once 'Controller_servicosAgenda.php';

class FuncServicoAgenda
{

    /*function salvar($request)
    {
    $idAgenda = $request->getParam('idAgenda');
    $idServicoSalao = $request->getParam('idServicoSalao');

    if($idAgenda!="" && $idServicoSalao!="")
    {
    $servicoAgenda = new ServicosAgenda();
    $servicoAgenda->setIdAgenda($idAgenda);
    $servicoAgenda->setIdServicoSalao($idServicoSalao);
    $retornoServicoAgenda = $servicoAgenda->sav_servicoAgenda();

    if($retornoServicoAgenda)
    {
    header('HTTP/1.1 204 01');//salvo
    exit(0);
    }
    else
    {
    header('HTTP/1.1 400 03');//erro ao salvar
    exit(0);
    }
    }
    else
    {
    header('HTTP/1.1 400 02');//parametros incorretos
    exit(0);
    }
    }

    function deletar($request)
    {
    $idServicoAgenda = $request->getAttribute('id');

    if($idServicoAgenda!="")
    {
    $servicoAgenda = new ServicosAgenda();
    $servicoAgenda->setIdServicoAgenda($idServicoAgenda);
    $retornoServicoAgenda = $servicoAgenda->exc_servicoAgenda();
    if($retornoServicoAgenda)
    {
    header('HTTP/1.1 204 01');//salvo
    exit(0);
    }
    else
    {
    header('HTTP/1.1 400 04');//erro ao salvar
    exit(0);
    }
    }
    else
    {
    header('HTTP/1.1 400 02');//parametros incorretos
    exit(0);
    }
    }*/

    public function getServicosAgenda($request)
    {
        $idAgenda = $request->getAttribute('id');
        $servicoAgenda = new ServicosAgenda();
        $servicoAgenda->setIdAgenda($idAgenda);
        $retornoServicoAgenda = $servicoAgenda->consult_sevicos_agenda();
        if (sizeof($retornoServicoAgenda) > 0) {
            header('HTTP/1.1 204 01'); //salvo
            echo json_encode($retornoServicoAgenda);
        } else {
            header('HTTP/1.1 400 04'); //erro ao salvar
            exit(0);
        }

    }

} //fim da classe
