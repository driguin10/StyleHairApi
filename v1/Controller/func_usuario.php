<?php
include_once 'Controller_usuario.php';
include_once 'Controller_login.php';
include_once 'Controller_funcionarios.php';
include_once 'Controller_salao.php';

class FuncUsuario
{

    public function salvar($request)
    {
        $file_path = "v1/imagensApp/";
        $pathImagem = "";

        if (isset($_POST['uploaded_file'])) {
            $imgName = 'img-' . md5(microtime()) . '.' . $_POST['mine_file'];
            $binary = base64_decode($_POST['uploaded_file']);

            if ($file = fopen($file_path . $imgName, 'wb')) {
                if (fwrite($file, $binary)) {
                    $pathImagem = $file_path . $imgName;
                }
            }
        }
        $idLogin = $request->getParam('idLogin');
        $nome = $request->getParam('nome');
        $apelido = $request->getParam('apelido');
        $sexo = $request->getParam('sexo');
        $dataNascimento = explode("-", $request->getParam('dataNascimento'));
        $telefone = $request->getParam('telefone');
        $cep = $request->getParam('cep');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $bairro = $request->getParam('bairro');
        $estado = $request->getParam('estado');
        $cidade = $request->getParam('cidade');
        $obs = $request->getParam('obs');
        $dataNascimento = $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0];

        if ($idLogin != "" && $nome != "" && $telefone != "" && $estado != "" && $cidade != "") {
            $topicoNotificacao = md5($nome . md5(date("Y-m-d H:i:s"), false), false);
            $Usuario = new Usuario();
            $Usuario->setIdLogin($idLogin);
            $Usuario->setTopicoNotificacao($topicoNotificacao);
            $Usuario->setLinkImagem($pathImagem);
            $Usuario->setNome($nome);
            $Usuario->setApelido($apelido);
            $Usuario->setSexo($sexo);
            $Usuario->setDataNascimento($dataNascimento);
            $Usuario->setTelefone($telefone);
            $Usuario->setCep($cep);
            $Usuario->setEndereco($endereco);
            $Usuario->setNumero($numero);
            $Usuario->setBairro($bairro);
            $Usuario->setEstado($estado);
            $Usuario->setCidade($cidade);
            $Usuario->setObs($obs);
            $retornoUsuario = $Usuario->sav_usuario();
            if ($retornoUsuario) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 03'); // erro ao salvar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // paramentros incorretos
            exit(0);
        }
    }

    public function userAnonimo($request)
    {
        $nome = $request->getParam('nome');
        $telefone = $request->getParam('telefone');

        if ($nome != "" && $telefone != "") {
            $Usuario = new Usuario();
            $Usuario->setIdLogin("-1");
            $Usuario->setTopicoNotificacao("0x00");
            $Usuario->setLinkImagem(null);
            $Usuario->setNome($nome);
            $Usuario->setApelido(null);
            $Usuario->setSexo(null);
            $Usuario->setDataNascimento(null);
            $Usuario->setTelefone($telefone);
            $Usuario->setCep(null);
            $Usuario->setEndereco(null);
            $Usuario->setNumero(null);
            $Usuario->setBairro(null);
            $Usuario->setEstado("*");
            $Usuario->setCidade("*");
            $Usuario->setObs(null);
            $retornoUsuario = $Usuario->sav_usuario();
            if ($retornoUsuario) {
                $idUsuario = $retornoUsuario->lastInsertId();
                $saida["idUsuario"] = $idUsuario;
                header('HTTP/1.1 200 01'); // salvo
                echo json_encode($saida);
            } else {
                header('HTTP/1.1 400 03'); // erro ao salvar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // paramentros incorretos
            exit(0);
        }
    }

    public function editar($request)
    {
        $file_path = "v1/imagensApp/";
        $pathImagem = "";

        if ($request->getParam('uploaded_file') != "" && $request->getParam('mine_file') != "") {
            if ($request->getParam('imagemAntiga')) {
                if (file_exists($request->getParam('imagemAntiga'))) {
                    unlink($request->getParam('imagemAntiga'));
                }
            }
            $imgName = 'img-' . md5(microtime()) . '.' . $request->getParam('mine_file');
            $binary = base64_decode($request->getParam('uploaded_file'));

            if ($file = fopen($file_path . $imgName, 'wb')) {
                if (fwrite($file, $binary)) {
                    $pathImagem = $file_path . $imgName;
                }
            }
        } else {
            if ($request->getParam('uploaded_file') == $request->getParam('imagemAntiga')) {
                $pathImagem = $request->getParam('imagemAntiga');
            } else {
                $pathImagem = "";
                if (file_exists($request->getParam('imagemAntiga'))) {
                    unlink($request->getParam('imagemAntiga'));
                }
            }
        }

        $idLogin = $request->getParam('idLogin');
        $nome = $request->getParam('nome');
        $apelido = $request->getParam('apelido');
        $sexo = $request->getParam('sexo');
        $dataNascimento = explode("-", $request->getParam('dataNascimento'));
        $telefone = $request->getParam('telefone');
        $cep = $request->getParam('cep');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $bairro = $request->getParam('bairro');
        $estado = $request->getParam('estado');
        $cidade = $request->getParam('cidade');
        $obs = $request->getParam('obs');
        $dataNascimento = $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0];

        if ($idLogin != "" && $nome != "" && $telefone != "" && $estado != "" && $cidade != "") {
            $Usuario = new Usuario();
            $Usuario->setIdLogin($idLogin);
            $Usuario->setLinkImagem($pathImagem);
            $Usuario->setNome($nome);
            $Usuario->setApelido($apelido);
            $Usuario->setSexo($sexo);
            $Usuario->setDataNascimento($dataNascimento);
            $Usuario->setTelefone($telefone);
            $Usuario->setCep($cep);
            $Usuario->setEndereco($endereco);
            $Usuario->setNumero($numero);
            $Usuario->setBairro($bairro);
            $Usuario->setEstado($estado);
            $Usuario->setCidade($cidade);
            $Usuario->setObs($obs);
            $retornoUsuario = $Usuario->alt_usuario();
            if ($retornoUsuario) {
                header('HTTP/1.1 204 01'); // editado com sucesso
                exit(0);
            } else {
                header('HTTP/1.1 400 04'); // erro ao editar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // paramentros incorretos
            exit(0);
        }
    }

    public function deletar($request)
    {
        $path = str_replace('v1/Controller', '', dirname(__FILE__));
        $idLogin = $request->getAttribute('id');

        if ($idLogin != "") {
            $Usuario = new Usuario();
            $Usuario->setIdLogin($idLogin);
            $retornoUsuario = $Usuario->get_usuario();
            if (sizeof($retornoUsuario) > 0) {
                $imagem = $path . $retornoUsuario[0]->linkImagem;
                if (file_exists($imagem)) {
                    unlink($imagem);
                }
            }
            $Usuario = new Usuario();
            $Usuario->setIdUsuario($idUsuario);
            $retornoUsuario = $Usuario->exc_usuario();

            if ($retornoUsuario) {
                header('HTTP/1.1 204 01'); // excluido
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // erro ao excluir
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // paramentros incorretos
            exit(0);
        }
    }

    public function deletarAnonimo($request)
    {
        $idUsuario = $request->getAttribute('id');

        if ($idUsuario != "") {
            $Usuario = new Usuario();
            $Usuario->setIdUsuario($idUsuario);
            $retornoUsuario = $Usuario->exc_usuario_anonimo();
            if ($retornoUsuario) {
                header('HTTP/1.1 204 01'); // excluido
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // erro ao excluir
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // paramentros incorretos
            exit(0);
        }
    }

    public function get_usuario($request)
    {
        $idLogin = $request->getAttribute('id');

        if ($idLogin != "") {
            $Usuario = new Usuario();
            $Usuario->setIdLogin($idLogin);
            $retornoUsuario = $Usuario->get_usuario();
            if (sizeof($retornoUsuario) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoUsuario);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }
    }

    public function get_usuario_id($request)
    {
        $idUsuario = $request->getAttribute('id');

        if ($idUsuario != "") {
            $Usuario = new Usuario();
            $Usuario->setIdUsuario($idUsuario);
            $retornoUsuario = $Usuario->get_usuario_Id();
            if (sizeof($retornoUsuario) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoUsuario);
            } else {
                header('HTTP/1.1 400 1'); // não emcontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }
    }

    public function tipoUsuario($request)
    {
        $idLogin = $request->getAttribute('id');
        if ($idLogin != "") {
            $Usuario = new Usuario();
            $Usuario->setIdLogin($idLogin);
            $retornoUsuario = $Usuario->get_usuario();
            if (sizeof($retornoUsuario) > 0) {
                $idUsuario = $retornoUsuario[0]->idUsuario; ///usuarioo
                $saida['idUsuario'] = $idUsuario;
                $saida['nomeUsuario'] = $retornoUsuario[0]->nome;
                $saida['topicoNotificacao'] = $retornoUsuario[0]->topicoNotificacao;
                $saida['linkImagem'] = $retornoUsuario[0]->linkImagem;
            } else {
                $saida['idUsuario'] = -1;
                $saida['nomeUsuario'] = "";
                $saida['topicoNotificacao'] = "";
                $saida['linkImagem'] = "";
            }

            $Funcionario = new Funcionario();
            $Funcionario->setIdUsuario($idUsuario);
            $retornoFuncionario = $Funcionario->consult_funcionarios_idUsuario();

            if (sizeof($retornoFuncionario) > 0) {
                $idFuncionario = $retornoFuncionario[0]->idFuncionario;
                $idSalaoFuncionario = $retornoFuncionario[0]->idSalao;
                $saida['idFuncionario'] = $idFuncionario;
                $saida['idSalaoFuncionario'] = $idSalaoFuncionario;
            } else {
                $saida['idFuncionario'] = -1;
                $saida['idSalaoFuncionario'] = -1;
            }

            $Salao = new Salao();
            $Salao->setIdUsuario($idUsuario);
            $retornoSalao = $Salao->get_salao();
            if (sizeof($retornoSalao) > 0) {
                $idSalao = $retornoSalao[0]->idSalao;
                $saida['idSalao'] = $idSalao;
            } else {
                $saida['idSalao'] = -1;
            }

            header('HTTP/1.1 200 01');
            echo json_encode($saida);
        } else {
            header('HTTP/1.1 400 2'); //parametros incorretos
            exit(0);
        }
    }

    public function criarLoginUsuario($request)
    {
        $email = $request->getParam('email');
        $senha = base64_encode($request->getParam('senha'));
        $login = new Login();
        $login->setEmail($email);
        $login->setSenha($senha);
        $retornoLoginVer = $login->ver_email();
        if (sizeof($retornoLoginVer) > 0) {
            header('HTTP/1.1 400 09'); //email já esta sendo usado
            exit(0);
        } else {
            $retornoLogin = $login->sav_login();
            if ($retornoLogin) {
                $retornoLoginCadastrado = $login->consult_usuario_senha();
                if (sizeof($retornoLoginCadastrado) > 0) //se achar algum regstro
                {
                    $idLogin = $retornoLoginCadastrado[0]->idLogin;
                    $file_path = "v1/imagensApp/";
                    $pathImagem = "";

                    if (isset($_POST['uploaded_file'])) {
                        $imgName = 'img-' . md5(microtime()) . '.' . $_POST['mine_file'];
                        $binary = base64_decode($_POST['uploaded_file']);

                        if ($file = fopen($file_path . $imgName, 'wb')) {
                            if (fwrite($file, $binary)) {
                                $pathImagem = $file_path . $imgName;
                            }
                        }
                    }

                    $nome = $request->getParam('nome');
                    $apelido = $request->getParam('apelido');
                    $sexo = $request->getParam('sexo');
                    $dataNascimento = explode("-", $request->getParam('dataNascimento'));
                    $telefone = $request->getParam('telefone');
                    $cep = $request->getParam('cep');
                    $endereco = $request->getParam('endereco');
                    $numero = $request->getParam('numero');
                    $bairro = $request->getParam('bairro');
                    $estado = $request->getParam('estado');
                    $cidade = $request->getParam('cidade');
                    $obs = $request->getParam('obs');
                    $dataNascimento = $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0];

                    if ($idLogin != "" && $nome != "" && $telefone != "" && $estado != "" && $cidade != "") {
                        $topicoNotificacao = md5($nome . md5(date("Y-m-d H:i:s"), false), false);
                        $Usuario = new Usuario();
                        $Usuario->setIdLogin($idLogin);
                        $Usuario->setTopicoNotificacao($topicoNotificacao);
                        $Usuario->setLinkImagem($pathImagem);
                        $Usuario->setNome($nome);
                        $Usuario->setApelido($apelido);
                        $Usuario->setSexo($sexo);
                        $Usuario->setDataNascimento($dataNascimento);
                        $Usuario->setTelefone($telefone);
                        $Usuario->setCep($cep);
                        $Usuario->setEndereco($endereco);
                        $Usuario->setNumero($numero);
                        $Usuario->setBairro($bairro);
                        $Usuario->setEstado($estado);
                        $Usuario->setCidade($cidade);
                        $Usuario->setObs($obs);
                        $retornoUsuario = $Usuario->sav_usuario();
                        if ($retornoUsuario) {
                            $idUsuario = $retornoUsuario->lastInsertId();
                            $saida["idUsuario"] = $idUsuario;
                            header('HTTP/1.1 200 01'); // salvo
                            echo json_encode($saida);
                        } else {
                            header('HTTP/1.1 400 03'); // erro ao salvar
                            exit(0);
                        }
                    } else {
                        header('HTTP/1.1 400 02'); // paramentros incorretos
                        exit(0);
                    }
                } //fim retorna login
            } //fim salvar login
        } //fim verifica se email esta sendo usado
    }

} //fim Classe
