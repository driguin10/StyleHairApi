<?php
include_once 'Controller_favorito.php';

class FavoritoUser
{

    public function salvar($request)
    {

        $idSalao = $request->getParam('idSalao');
        $idLogin = $request->getParam('idLogin');

        if ($idSalao != "" && $idLogin != "") {
            $favoritoUser = new Favorito();
            $favoritoUser->setIdLogin($idLogin);
            $favoritoUser->setIdSalao($idSalao);
            $retornoFavorito = $favoritoUser->sav_favorito();
            if ($retornoFavorito) {
                $idFavorito = $retornoFavorito->lastInsertId();
                $saida['idFavorito'] = $idFavorito;
                header('HTTP/1.1 200 01'); // nao encontrado
                echo json_encode($saida);
                //exit(0);
            } else {
                header('HTTP/1.1 400 03'); // erro
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // salvo
            exit(0);
        }
    }

    public function deletar($request)
    {
        $idFavorito = $request->getAttribute('id');

        if ($idFavorito != "") {
            $favoritoUser = new Favorito();
            $favoritoUser->setIdFavorito($idFavorito);
            $retornoFavorito = $favoritoUser->exc_fav();
            if ($retornoFavorito) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // erro
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // paramentros incorretos
            exit(0);
        }
    }

    public function get_favoritos_idFav($request)
    {
        $idFavorito = $request->getAttribute('id');

        if ($idFavorito != "") {
            $favoritoUser = new Favorito();
            $favoritoUser->setIdFavorito($idFavorito);
            $retornoFavorito = $favoritoUser->consult_id_fav();
            if (sizeof($retornoFavorito) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoFavorito);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }
    }

    public function get_favoritos_idLog($request)
    {
        $idLogin = $request->getAttribute('id');

        if ($idLogin != "") {
            $favoritoUser = new Favorito();
            $favoritoUser->setIdLogin($idLogin);
            $retornoFavorito = $favoritoUser->consult_id_login();
            if (sizeof($retornoFavorito) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoFavorito);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }
    }

    public function get_favoritos_idSal($request)
    {
        $idSalao = $request->getAttribute('id');

        if ($idSalao != "") {
            $favoritoUser = new Favorito();
            $favoritoUser->setIdSalao($idSalao);
            $retornoFavorito = $favoritoUser->consult_id_salao();
            if (sizeof($retornoFavorito) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoFavorito);
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
