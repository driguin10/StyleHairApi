<?php
include_once 'Controller_avaliacoes.php';

class Avaliacoes
{

    public function salvar($request)
    {
        $idSalao = $request->getParam('idSalao');
        $pontos = $request->getParam('pontos');
        $comentario = $request->getParam('comentario');
        $data = $request->getParam('data');

        if ($idSalao != "") {
            $avaliacao = new Avaliacao();
            $avaliacao->setIdSalao($idSalao);
            $avaliacao->setPontos($pontos);
            $avaliacao->setComentario($comentario);
            $avaliacao->setData($data);
            $retornoAvaliacao = $avaliacao->sav_avaliacao();
            if ($retornoAvaliacao) {
                header('HTTP/1.1 204 01');
                exit(0);
            } else {
                header('HTTP/1.1 400 03'); // erro ao salvar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); //parametros incorretos
            exit(0);
        }
    }

    public function deletar($request)
    {
        $idAvaliacao = $request->getAttribute('id');
        if ($idAvaliacao != "") {
            $avaliacao = new Avaliacao();
            $avaliacao->setIdAvaliacao($idAvaliacao);
            $retornoAvaliacao = $avaliacao->exc_avaliacao();
            if ($retornoAvaliacao) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 05');
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); //parametros incorretos
            exit(0);
        }
    }

    public function deletarComentario($request)
    {
        $idAvaliacao = $request->getAttribute('id');
        if ($idAvaliacao != "") {
            $avaliacao = new Avaliacao();
            $avaliacao->setIdAvaliacao($idAvaliacao);
            $retornoAvaliacao = $avaliacao->exc_comentario();
            if ($retornoAvaliacao) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 05');
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); //parametros incorretos
            exit(0);
        }
    }

    public function get_avaliacoes($request)
    {
        $idSalao = $request->getAttribute('id');

        if ($idSalao != "") {
            $avaliacao = new Avaliacao();
            $avaliacao->setIdSalao($idSalao);
            $retornoAvaliacao = $avaliacao->consult_avaliacao();
            if (sizeof($retornoAvaliacao) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoAvaliacao);
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
