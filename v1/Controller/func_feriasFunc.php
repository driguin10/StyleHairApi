<?php
include_once 'Controller_feriasFunc.php';
include_once 'Controller_login.php';
class FuncFerias_Func
{

    public function salvar($request)
    {
        $IdFuncionario = $request->getParam('idFuncionario');
        $dataIni = $request->getParam('dataIni');
        $dataFim = $request->getParam('dataFim');

        if ($IdFuncionario != "" && $dataIni != "" && $dataFim != "") {
            $feriasFunc = new FeriasFunc();
            $feriasFunc->setIdFuncionario($IdFuncionario);
            $feriasFunc->setDataIni($dataIni);
            $feriasFunc->setDataFim($dataFim);
            $retornoFeriasFunc = $feriasFunc->sav_feriasFunc();

            if ($retornoFeriasFunc) {
                header('HTTP/1.1 204 01'); //salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 03'); //erro ao salvar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); //parametros incorretos
            exit(0);
        }
    }

    public function editar($request)
    {
        $IdFeriasFunc = $request->getParam('idFeriasFunc');
        $dataIni = $request->getParam('dataIni');
        $dataFim = $request->getParam('dataFim');

        if ($IdFeriasFunc != "" && $dataIni != "" && $dataFim != "") {
            $feriasFunc = new FeriasFunc();
            $feriasFunc->setIdFeriasFunc($IdFeriasFunc);
            $feriasFunc->setDataIni($dataIni);
            $feriasFunc->setDataFim($dataFim);
            $retornoFeriasFunc = $feriasFunc->alt_feriasFunc();
            if ($retornoFeriasFunc) {
                header('HTTP/1.1 204 01'); //editadoo
                exit(0);
            } else {
                header('HTTP/1.1 400 04'); //erro ao editar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); //parametros incorretos
            exit(0);
        }
    }

    public function deletar($request)
    {
        $IdFeriasFunc = $request->getAttribute('id');

        if ($IdFeriasFunc != "") {
            $feriasFunc = new FeriasFunc();
            $feriasFunc->setIdFeriasFunc($IdFeriasFunc);
            $retornoFeriasFunc = $feriasFunc->exc_feriasFunc();
            if ($retornoFeriasFunc) {
                header('HTTP/1.1 204 01'); //excluido
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); //erro ao excluir
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); //parametros incorretos
            exit(0);
        }
    }

    public function get_feriasId($request)
    {
        $idFuncionario = $request->getAttribute('id');

        if ($idFuncionario != "") {
            $feriasFunc = new FeriasFunc();
            $feriasFunc->setIdFuncionario($idFuncionario);
            $retornoFuncionario = $feriasFunc->consult_id();
            if (sizeof($retornoFuncionario) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoFuncionario);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }
    }

} //fim da classe
