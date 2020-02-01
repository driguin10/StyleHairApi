<?php
include_once 'Controller_servicosFunc.php';

class ServicosFunc
{

    public function salvar($request)
    {
        $idFuncionario = $request->getParam('idFuncionario');
        $idServicoSalao = $request->getParam('idServicoSalao');

        if ($idFuncionario != "" && $idServicoSalao != "") {
            $servicoFunc = new ServicoFunc();
            $servicoFunc->setIdFuncionario($idFuncionario);
            $servicoFunc->setIdServicoSalao($idServicoSalao);
            $retornoVerifica = $servicoFunc->consult_idFunc_idServ();

            if (sizeof($retornoVerifica) > 0) {
                header('HTTP/1.1 400 01'); // nao encontrado
                exit(0);
            } else {
                $retornoServicoFunc = $servicoFunc->sav_servicoFunc();
                if ($retornoServicoFunc) {
                    header('HTTP/1.1 204 01'); // salvo
                    exit(0);
                } else {
                    header('HTTP/1.1 400 03'); // erro
                    exit(0);
                }
            }
        } else {
            header('HTTP/1.1 400 02'); // salvo
            exit(0);
        }
    }

    public function editar($request)
    {
        $idServicoFunc = $request->getParam('idServicoFunc');
        $idServicoSalao = $request->getParam('idServicoSalao');

        if ($idServicoFunc != "" && $idServicoSalao != "") {
            $servicoFunc = new ServicoFunc();
            $servicoFunc->setIdServicoFunc($idServicoFunc);
            $servicoFunc->setIdServicoSalao($idServicoSalao);
            $retornoServicoFunc = $servicoFunc->alt_servicoFunc();

            if ($retornoServicoFunc) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 04'); // salvo
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // salvo
            exit(0);
        }
    }

    public function deletar($request)
    {
        $idServicoFunc = $request->getAttribute('id');

        if ($idServicoFunc != "") {
            $servicoFunc = new ServicoFunc();
            $servicoFunc->setIdServicoFunc($idServicoFunc);
            $retornoServicoFunc = $servicoFunc->exc_servicoFunc();
            if ($retornoServicoFunc) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // salvo
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // salvo
            exit(0);
        }
    }

    public function get_servicos($request)
    {
        $idFuncionario = $request->getAttribute('id');

        if ($idFuncionario != "") {
            $servicoFunc = new ServicoFunc();
            $servicoFunc->setIdFuncionario($idFuncionario);
            $retornoservicoFunc = $servicoFunc->consult_servicos_func();
            if (sizeof($retornoservicoFunc) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoservicoFunc);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }

    }

}
