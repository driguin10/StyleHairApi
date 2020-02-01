<?php
include_once 'Controller_notificacao.php';
include_once 'Controller_usuario.php';
include_once "enviaNotfication.php";
class Notifica
{

    public function deletar($request)
    {
        $idNotificacao = $request->getAttribute('id');
        if ($idNotificacao != "") {
            $newNotificacao = new Notificacao();
            $newNotificacao->setIdNotificacao($idNotificacao);
            $retornoNotificacao = $newNotificacao->exc_notificacao();
            if ($retornoNotificacao) {
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

    public function get_notificacoes($request)
    {

        $idUsuario = $request->getAttribute('id');

        if ($idUsuario != "") {
            $newNotificacao = new Notificacao();
            $newNotificacao->setIdUsuario($idUsuario);
            $retornoNotificacao = $newNotificacao->get_notificacao();
            if (sizeof($retornoNotificacao) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoNotificacao);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }

    }

    public function altera_notificacoes($request)
    {
        $idNotificacao = $request->getAttribute('idNotificacao');
        $visualizado = $request->getAttribute('visualizado');

        if ($idNotificacao != "" && $visualizado != "") {
            $newNotificacao = new Notificacao();
            $newNotificacao->setIdNotificacao($idNotificacao);
            $newNotificacao->setVisualizado($visualizado);
            $retornoNotificacao = $newNotificacao->alt_visualizacao();
            if ($retornoNotificacao) {
                header('HTTP/1.1 200 01');
                exit(0);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }

    }

    public function enviarNotificacao($request)
    {

        $tz_object = new DateTimeZone('Brazil/East');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        $hora = $datetime->format('H:m');

        $quem = $request->getParam('quem');

        $id = $request->getParam('id'); //id do salao ou id login do usuario

        $titulo = $request->getParam('titulo');
        $menssagem = $request->getParam('menssagem');
        $nomeSalao = $request->getParam('nomeSalao');

        if ($quem == "0") //todos os clientes
        {
            $newNotificacao = new Notificacao();
            $retornoLogins = $newNotificacao->get_logins($id); // pega todos usuarios que possui o salao como favorito

            if (sizeof($retornoLogins) > 0) {
                foreach ($retornoLogins as $key) {
                    $idLogin = $key->idLogin;
                    $newNotificacaoUser = new Notificacao();
                    $newNotificacaoUser->setIdUsuario($idLogin);
                    $newNotificacaoUser->setTitulo($titulo);
                    $newNotificacaoUser->setCorpo($menssagem);
                    $newNotificacaoUser->setData($hora);
                    $newNotificacaoUser->setVisualizado("0");
                    $newNotificacaoUser->setNomeSalao($nomeSalao);
                    $retornoNewNotificacaoUser = $newNotificacaoUser->sav_notificacao();
                    $this->enviaPush($idLogin);
                }
                header('HTTP/1.1 204 01');
                exit(0);
            }
        } else //funcionario
        {
            $newNotificacaoUser = new Notificacao();
            $newNotificacaoUser->setIdUsuario($id);
            $newNotificacaoUser->setTitulo($titulo);
            $newNotificacaoUser->setCorpo($menssagem);
            $newNotificacaoUser->setData($hora);
            $newNotificacaoUser->setVisualizado("0");
            $newNotificacaoUser->setNomeSalao($nomeSalao);
            $retornoNewNotificacaoUser = $newNotificacaoUser->sav_notificacao();
            $retr= $this->enviaPush($id);
            header('HTTP/1.1 204 01');
            exit(0);
        }

    }

    public function enviaPush($id)
    {
        $Usuario = new Usuario();
        $Usuario->setIdLogin($id);
        $retornoUsuario = $Usuario->get_usuario();
        if (sizeof($retornoUsuario) > 0) {
            $topico = $retornoUsuario[0]->topicoNotificacao;
        }
        $enviaNotification = new enviaNotification();
        return $enviaNotification->EnviarNotificacao("StyleHair", "Nova Notificação", "", "", $topico);

    }

}
