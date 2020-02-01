<?php
include_once 'Controller_excluir_contas.php';
include_once 'Controller_usuario.php';
include_once 'Controller_funcionarios.php';
include_once 'Controller_agenda.php';
include_once 'Controller_salao.php';

class FuncExcluir
{

    public function deletarUsuarioComum($request)
    {
        $idLogin = $request->getParam('idLogin');

        if ($idLogin != "") {
            $excluir = new Excluir();
            $retornoExcluir = $excluir->exc_usuario_comum($idLogin);
            if ($retornoExcluir) {
                header('HTTP/1.1 200 01');
                exit;
            } else {
                header('HTTP/1.1 400 01');
                exit;
            }
        }
    }

    public function deletarUsuario($request)
    {
        $idLogin = $request->getParam('idLogin');
        $idUsuario = $request->getParam('idUsuario');
        if ($idLogin != "" && $idUsuario != "") {
            $Usuario = new Usuario();
            $Usuario->setIdUsuario($idUsuario);
            $retornoUsuario = $Usuario->get_usuario_Id();
            if (sizeof($retornoUsuario) > 0) {
                $path = str_replace('v1/Controller', '', dirname(__FILE__));
                $imagem = $path . $retornoUsuario[0]->linkImagem;
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }

            $excluir = new Excluir();
            $retornoExcluir = $excluir->exc_usuario($idLogin, $idUsuario);
            if ($retornoExcluir) {
                header('HTTP/1.1 200 01');
                exit;
            } else {
                header('HTTP/1.1 400 01');
                exit;
            }
        }
    }

    public function deletarFuncionario($request)
    {

        $idLogin = $request->getParam('idLogin');
        $idUsuario = $request->getParam('idUsuario');
        $idFuncionario = $request->getParam('idFuncionario');
        if ($idLogin != "" && $idUsuario != "" && $idFuncionario != "") {
            $Usuario = new Usuario();
            $Usuario->setIdUsuario($idUsuario);
            $retornoUsuario = $Usuario->get_usuario_Id();
            if (sizeof($retornoUsuario) > 0) {
                $path = str_replace('v1/Controller', '', dirname(__FILE__));
                $imagem = $path . $retornoUsuario[0]->linkImagem;
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }

            $excluir = new Excluir();
            $retornoExcluir = $excluir->exc_funcionario($idLogin, $idUsuario, $idFuncionario);
            if ($retornoExcluir) {
                header('HTTP/1.1 200 01');
                exit;
            } else {
                header('HTTP/1.1 400 01');
                exit;
            }
        }
    }

    public function deletarGerente($request)
    {
        $idLogin = $request->getParam('idLogin');
        $idUsuario = $request->getParam('idUsuario');
        $idFuncionario = $request->getParam('idFuncionario');
        $idSalao = $request->getParam('idSalao');
        if ($idLogin != "" && $idUsuario != "" && $idFuncionario != "" && $idSalao != "") {

            $path = str_replace('v1/Controller', '', dirname(__FILE__));
            $funcionario = new Funcionario();
            $funcionario->setIdSalao($idSalao);
            $retornoFuncionario = $funcionario->consult_funcionarios_idSalao();
            if (sizeof($retornoFuncionario) > 0) {
                for ($x = 0; $x < sizeof($retornoFuncionario); $x++) {
                    $agenda = new Agenda();
                    $agenda->setIdFuncionario($retornoFuncionario[0]->idFuncionario);
                    $agenda->setStatus(0);
                    $retornoAgenda = $agenda->alt_status_func();
                }
            }

            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $retornoSalao = $Salao->get_salao_idSalao();
            if (sizeof($retornoSalao) > 0) {
                $imagem = $path . $retornoSalao[0]->linkImagem;
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }

            $Usuario = new Usuario();
            $Usuario->setIdUsuario($idUsuario);
            $retornoUsuario = $Usuario->get_usuario_Id();
            if (sizeof($retornoUsuario) > 0) {
                $imagem = $path . $retornoUsuario[0]->linkImagem;
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }

            $excluir = new Excluir();
            $retornoExcluir = $excluir->exc_gerente($idLogin, $idUsuario, $idFuncionario, $idSalao);
            if ($retornoExcluir) {
                header('HTTP/1.1 200 01');
                exit;
            } else {
                header('HTTP/1.1 400 01');
                exit;
            }
        }
    }

    public function deletarGerenteLogin($request)
    {
        $idUsuario = $request->getParam('idUsuario');
        $idFuncionario = $request->getParam('idFuncionario');
        $idSalao = $request->getParam('idSalao');

        if ($idUsuario != "" && $idFuncionario != "" && $idSalao != "") {

            $funcionario = new Funcionario();
            $funcionario->setIdSalao($idSalao);
            $retornoFuncionario = $funcionario->consult_funcionarios_idSalao();
            if (sizeof($retornoFuncionario) > 0) {
                for ($x = 0; $x < sizeof($retornoFuncionario); $x++) {
                    $agenda = new Agenda();
                    $agenda->setIdFuncionario($retornoFuncionario[0]->idFuncionario);
                    $agenda->setStatus(0);
                    $retornoAgenda = $agenda->alt_status_func();
                }
            }

            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $retornoSalao = $Salao->get_salao_idSalao();
            if (sizeof($retornoSalao) > 0) {
                $path = str_replace('v1/Controller', '', dirname(__FILE__));
                $imagem = $path . $retornoSalao[0]->linkImagem;
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }

            $excluir = new Excluir();
            $retornoExcluir = $excluir->exc_gerente_login($idUsuario, $idFuncionario, $idSalao);
            if ($retornoExcluir) {
                header('HTTP/1.1 200 01');
                exit;
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
