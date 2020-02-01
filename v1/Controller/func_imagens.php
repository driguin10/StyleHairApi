<?php
include_once 'Controller_imagens.php';
include_once 'Controller_login.php';
class Imagens
{

    public function salvar($request)
    {

        $caminho = $request->getParam('caminho');
        $apiKey = $request->getParam('apiKey');

        if ($caminho != "" && $apiKey != "") {
            $getKey = new Login();
            $getKey->setApiKey($apiKey);
            $findKey = $getKey->consult_all_key();
            if (sizeof($findKey) > 0) {

                $imagens = new Imagem();
                $imagens->setcaminho($caminho);
                $retornoImagens = $imagens->sav_imagem();
                if ($retornoImagens) {
                    $resultado["result"] = "3x1"; // codigo usuario cadastrado
                    echo json_encode($resultado);
                } else {
                    $resultado["result"] = "3x0"; // codigo erro ao cadastrar
                    echo json_encode($resultado);
                }
            } else {
                $resultado["result"] = "3x001"; // codigo erro ao cadastrar
                echo json_encode($resultado);
            }
        } else {
            $resultado["result"] = "3x000"; // codigo dados incorretos
            echo json_encode($resultado);
        }
    }

    public function editar($request)
    {
        $caminho = $request->getParam('caminho');
        $idImagem = $request->getParam('idImagem');
        $apiKey = $request->getParam('apiKey');

        if ($idImagem != "" && $caminho != "" && $apiKey != "") {
            $getKey = new Login();
            $getKey->setApiKey($apiKey);
            $findKey = $getKey->consult_all_key();
            if (sizeof($findKey) > 0) {

                $imagens = new Imagem();
                $imagens->setIdImagem($idImagem);
                $imagens->setcaminho($caminho);
                $retornoImagens = $imagens->alt_imagem();
                if ($retornoImagens) {
                    $resultado["result"] = "3x1"; // codigo usuario cadastrado
                    echo json_encode($resultado);
                } else {
                    $resultado["result"] = "3x0"; // codigo erro ao cadastrar
                    echo json_encode($resultado);
                }
            } else {
                $resultado["result"] = "3x001"; // codigo erro ao cadastrar
                echo json_encode($resultado);
            }
        } else {
            $resultado["result"] = "3x000"; // codigo dados incorretos
            echo json_encode($resultado);
        }
    }

    public function deletar($request)
    {
        $idImagem = $request->getAttribute('id');

        $apiKey = $request->getParam('apiKey');

        if ($idImagem != "" && $apiKey != "") {
            $getKey = new Login();
            $getKey->setApiKey($apiKey);
            $findKey = $getKey->consult_all_key();
            if (sizeof($findKey) > 0) {
                $imagens = new Imagem();
                $imagens->setIdImagem($idImagem);
                $retornoImagens = $imagens->exc_imagem();
                if ($retornoImagens) {
                    $resultado["result"] = "5x1"; // codigo usuario cadastrado
                    echo json_encode($resultado);
                } else {
                    $resultado["result"] = "5x0"; // codigo erro ao cadastrar
                    echo json_encode($resultado);
                }
            } else {
                $resultado["result"] = "5x0"; // codigo erro ao cadastrar
                echo json_encode($resultado);
            }
        } else {
            $resultado["result"] = "5x000"; // codigo dados incorretos
            echo json_encode($resultado);
        }
    }

}
