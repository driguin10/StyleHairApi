<?php

include_once 'Controller_servicosSalao.php';

class FuncServicoSalao
{

    public function salvar($request)
    {
        $idSalao = $request->getParam('idSalao');
        $servico = $request->getParam('servico');
        $sexo = $request->getParam('sexo');
        $valor = $request->getParam('valor');
        $tempo = $request->getParam('tempo');

        if ($idSalao != "" && $servico != "" && $sexo != "" && $valor != "" && $tempo != "") {
            $servicosSalao = new ServicosSalao();
            $servicosSalao->setIdSalao($idSalao);
            $servicosSalao->setServico($servico);
            $servicosSalao->setSexo($sexo);
            $servicosSalao->setValor($valor);
            $servicosSalao->setTempo($tempo);
            $retornoServicosSalao = $servicosSalao->sav_servicosSalao();
            if ($retornoServicosSalao) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 03'); // salvo
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // salvo
            exit(0);
        }
    }

    public function editar($request)
    {
        $idServicoSalao = $request->getParam('idServicoSalao');
        $servico = $request->getParam('servico');
        $sexo = $request->getParam('sexo');
        $valor = $request->getParam('valor');
        $tempo = $request->getParam('tempo');

        if ($idServicoSalao != "" && $servico != "" && $sexo != "" && $valor != "" && $tempo != "") {
            $servicosSalao = new ServicosSalao();
            $servicosSalao->setIdServicoSalao($idServicoSalao);
            $servicosSalao->setServico($servico);
            $servicosSalao->setSexo($sexo);
            $servicosSalao->setValor($valor);
            $servicosSalao->setTempo($tempo);
            $retornoServicosSalao = $servicosSalao->alt_servicosSalao();
            if ($retornoServicosSalao) {
                header('HTTP/1.1 204 01'); // editado
                exit(0);
            } else {
                header('HTTP/1.1 400 04'); // erro ao editar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // parametros incorretos
            exit(0);
        }
    }

    public function get_servico_salao($request)
    {
        $idSalao = $request->getAttribute('id');

        if ($idSalao != "") {
            $Servico = new ServicosSalao();
            $Servico->setIdSalao($idSalao);
            $retornoServico = $Servico->consult_servicos_idSalao();
            if (sizeof($retornoServico) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoServico);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function deletar($request)
    {
        $idServicoSalao = $request->getAttribute('id');

        if ($idServicoSalao != "") {

            $servicoSalao = new ServicosSalao();
            $servicoSalao->setIdServicoSalao($idServicoSalao);
            $retornoServicoSalao = $servicoSalao->exc_servicosSalao();

            if ($retornoServicoSalao) {
                header('HTTP/1.1 204 01'); // excluido
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // erro ao editar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // parametros incorretos
            exit(0);
        }

    }
}
