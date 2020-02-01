<?php
include_once 'Controller_salao.php';
include_once "func_funcionario.php";
include_once 'Controller_usuario.php';
include_once 'Controller_funcionarios.php';
include_once 'Controller_servicosSalao.php';

class FuncSaloes
{
    public function salvar($request)
    {
        $entradaPadrao = "09:00";
        $saidaPadrao = "19:00";
        $padraoFolga = null;
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

        $idUsuario = $request->getParam('idUsuario');
        $nome = $request->getParam('nome');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $cep = $request->getParam('cep');
        $bairro = $request->getParam('bairro');
        $estado = $request->getParam('estado');
        $latitude = $request->getParam('latitude');
        $longitude = $request->getParam('longitude');
        $cidade = $request->getParam('cidade');
        $telefone1 = $request->getParam('telefone1');
        $telefone2 = $request->getParam('telefone2');
        $cnpj = $request->getParam('cnpj');
        $email = $request->getParam('email');
        $sobre = $request->getParam('sobre');
        $agendamento = $request->getParam('agendamento');
        $status = 1; //padrão aberto

//---------------- horario padrão---------------------------------
        $SegE = $entradaPadrao;
        $SegS = $saidaPadrao;
        $TerE = $entradaPadrao;
        $TerS = $saidaPadrao;
        $QuaE = $entradaPadrao;
        $QuaS = $saidaPadrao;
        $QuiE = $entradaPadrao;
        $QuiS = $saidaPadrao;
        $SexE = $entradaPadrao;
        $SexS = $saidaPadrao;
        $SabE = $entradaPadrao;
        $SabS = $saidaPadrao;
        $DomE = null;
        $DomS = null;
        $tempoReserva = "00:30";
        $tempoMinReserva = "00:30";
//------------------------------------------------------------------

        if ($idUsuario != "" && $nome != "" && $endereco != "" && $numero != "" && $cep != ""
            && $bairro != "" && $cidade != "" && $estado != "" && $telefone1 != "" && $email != "") {
            $topicoNotificacao = md5($nome . md5(date("Y-m-d H:i:s"), false), false);
            $Salao = new Salao();
            $Salao->setIdUsuario($idUsuario);
            $Salao->setTopicoNotificacao($topicoNotificacao);
            $Salao->setNome($nome);
            $Salao->setEndereco($endereco);
            $Salao->setNumero($numero);
            $Salao->setComplemento($complemento);
            $Salao->setCep($cep);
            $Salao->setBairro($bairro);
            $Salao->setCidade($cidade);
            $Salao->setEstado($estado);
            $Salao->setLatitude($latitude);
            $Salao->setLongitude($longitude);
            $Salao->setTelefone1($telefone1);
            $Salao->setTelefone2($telefone2);
            $Salao->setCnpj($cnpj);
            $Salao->setEmail($email);
            $Salao->setSobre($sobre);
            $Salao->setLinkImagem($pathImagem);
            $Salao->setAgendamento($agendamento);
            $Salao->setStatus($status);
            $Salao->setSegE($SegE);
            $Salao->setSegS($SegS);
            $Salao->setTerE($TerE);
            $Salao->setTerS($TerS);
            $Salao->setQuaE($QuaE);
            $Salao->setQuaS($QuaS);
            $Salao->setQuiE($QuiE);
            $Salao->setQuiS($QuiS);
            $Salao->setSexE($SexE);
            $Salao->setSexS($SexS);
            $Salao->setSabE($SabE);
            $Salao->setSabS($SabS);
            $Salao->setDomE($DomE);
            $Salao->setDomS($DomS);
            $Salao->setTempoReserva($tempoReserva);
            $Salao->setTempoMinAgenda($tempoMinReserva);
            $retornoSalao = $Salao->sav_salao();

            if ($retornoSalao) {
                $funcFunc = new FuncFuncionario();
                $retornoSalao = $Salao->get_salao();

                if (sizeof($retornoSalao) > 0) {
                    $criaFuncionario = $funcFunc->criarFuncionario($retornoSalao[0]->idSalao, $idUsuario);
                    if ($criaFuncionario != "") {
                        header('HTTP/1.1 204 01'); // salvo
                        exit(0);
                    } else {
                        header('HTTP/1.1 400 07'); // erro ao salvar
                        exit(0);
                    }
                }
            } else {
                header('HTTP/1.1 400 07'); // erro ao salvar
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

        $idSalao = $request->getParam('idSalao');
        $nome = $request->getParam('nome');
        $endereco = $request->getParam('endereco');
        $numero = $request->getParam('numero');
        $complemento = $request->getParam('complemento');
        $cep = $request->getParam('cep');
        $bairro = $request->getParam('bairro');
        $estado = $request->getParam('estado');
        $latitude = $request->getParam('latitude');
        $longitude = $request->getParam('longitude');
        $cidade = $request->getParam('cidade');
        $telefone1 = $request->getParam('telefone1');
        $telefone2 = $request->getParam('telefone2');
        $cnpj = $request->getParam('cnpj');
        $email = $request->getParam('email');
        $sobre = $request->getParam('sobre');
        $agendamento = $request->getParam('agendamento');

        if ($idSalao != "" && $nome != "" && $endereco != "" && $numero != "" && $cep != ""
            && $bairro != "" && $cidade != "" && $estado != "" && $telefone1 != "" && $email != "") {
            $topicoNotificacao = base64_encode($nome . md5(microtime()));
            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $Salao->setNome($nome);
            $Salao->setEndereco($endereco);
            $Salao->setNumero($numero);
            $Salao->setComplemento($complemento);
            $Salao->setCep($cep);
            $Salao->setBairro($bairro);
            $Salao->setCidade($cidade);
            $Salao->setEstado($estado);
            $Salao->setLatitude($latitude);
            $Salao->setLongitude($longitude);
            $Salao->setTelefone1($telefone1);
            $Salao->setTelefone2($telefone2);
            $Salao->setCnpj($cnpj);
            $Salao->setEmail($email);
            $Salao->setSobre($sobre);
            $Salao->setLinkImagem($pathImagem);
            $Salao->setAgendamento($agendamento);
            $retornoSalao = $Salao->alt_salao();

            if ($retornoSalao) {
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

    public function trocarGerencia($request)
    {
        $idSalao = $request->getParam('idSalao');
        $idUsuario = $request->getParam('idUsuario');

        if ($idSalao != "" && $idUsuario != "") {
            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $Salao->setIdUsuario($idUsuario);
            $retornoSalao = $Salao->alt_gerente_salao();
            if ($retornoSalao) {
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

    public function configuracoes($request)
    {
        $entradaPadrao = "09:00";
        $saidaPadrao = "19:00";
        $padraoFolga = null;
        $idSalao = $request->getParam('idSalao');
        $tempoReserva = $request->getParam('tempoReserva');
        $tempoMinReserva = $request->getParam('tempoMinReserva');
        $SegE = $request->getParam('segE');
        $SegS = $request->getParam('segS');
        $TerE = $request->getParam('terE');
        $TerS = $request->getParam('terS');
        $QuaE = $request->getParam('quaE');
        $QuaS = $request->getParam('quaS');
        $QuiE = $request->getParam('quiE');
        $QuiS = $request->getParam('quiS');
        $SexE = $request->getParam('sexE');
        $SexS = $request->getParam('sexS');
        $SabE = $request->getParam('sabE');
        $SabS = $request->getParam('sabS');
        $DomE = $request->getParam('domE');
        $DomS = $request->getParam('domS');

        if ($SegE == "") {
            $SegE = $padraoFolga;
        }

        if ($SegS == "") {
            $SegS = $padraoFolga;
        }

        if ($TerE == "") {
            $TerE = $padraoFolga;
        }

        if ($TerS == "") {
            $TerS = $padraoFolga;
        }

        if ($QuaE == "") {
            $QuaE = $padraoFolga;
        }

        if ($QuaS == "") {
            $QuaS = $padraoFolga;
        }

        if ($QuiE == "") {
            $QuiE = $padraoFolga;
        }

        if ($QuiS == "") {
            $QuiS = $padraoFolga;
        }

        if ($SexE == "") {
            $SexE = $padraoFolga;
        }

        if ($SexS == "") {
            $SexS = $padraoFolga;
        }

        if ($SabE == "") {
            $SabE = $padraoFolga;
        }

        if ($SabS == "") {
            $SabS = $padraoFolga;
        }

        if ($DomE == "") {
            $DomE = $padraoFolga;
        }

        if ($DomS == "") {
            $DomS = $padraoFolga;
        }

        if ($tempoReserva == "") {
            $tempoReserva = "00:30";
        }

        if ($tempoMinReserva == "") {
            $tempoMinReserva = "00:30";
        }

        if ($idSalao != "") {
            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $Salao->setSegE($SegE);
            $Salao->setSegS($SegS);
            $Salao->setTerE($TerE);
            $Salao->setTerS($TerS);
            $Salao->setQuaE($QuaE);
            $Salao->setQuaS($QuaS);
            $Salao->setQuiE($QuiE);
            $Salao->setQuiS($QuiS);
            $Salao->setSexE($SexE);
            $Salao->setSexS($SexS);
            $Salao->setSabE($SabE);
            $Salao->setSabS($SabS);
            $Salao->setDomE($DomE);
            $Salao->setDomS($DomS);
            $Salao->setTempoReserva($tempoReserva);
            $Salao->setTempoMinAgenda($tempoMinReserva);

            $retornoSalao = $Salao->alt_config_salao();
            if ($retornoSalao) {
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

    public function editar_status($request)
    {
        $idSalao = $request->getParam('idSalao');
        $status = $request->getParam('status');

        if ($idSalao != "") {
            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $Salao->setStatus($status);
            $retornoSalao = $Salao->alt_status_salao();
            if ($retornoSalao) {
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

    public function get_salao($request)
    {
        $idUsuario = $request->getAttribute('id');

        if ($idUsuario != "") {
            $Salao = new Salao();
            $Salao->setIdUsuario($idUsuario);
            $retornoSalao = $Salao->get_salao();
            if (sizeof($retornoSalao) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoSalao);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function get_salao_idSalao($request)
    {
        $idSalao = $request->getAttribute('id');

        if ($idSalao != "") {
            $Salao = new Salao();
            $Salao->setIdSalao($idSalao);
            $retornoSalao = $Salao->get_salao_idSalao();
            if (sizeof($retornoSalao) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoSalao);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function buscarSalao($request)
    {
        $pagina = $request->getParam('pagina');
        $qtRegistro = $request->getParam('qtRegistro');

        if ($pagina == "") {
            $pagina = 0;
        }

        if ($qtRegistro == "") {
            $qtRegistro = $pagina;
        }

        $kilometro = $request->getParam('kilometro');
        $idLogin = $request->getParam('idLogin');

        if ($kilometro == "") {
            $kilometro = 5;
        }

        if ($idLogin == "") {
            $idLogin = '';
        }

        $nome = $request->getParam('nome');
        $cidade = $request->getParam('cidade');
        $latitude = $request->getParam('latitude');
        $longitude = $request->getParam('longitude');
        $Salao = new Salao();

        if ($nome != "") {
            $Salao->setNome($nome);
        } else {
            $Salao->setNome(null);
        }

        if ($cidade != "") {
            $Salao->setCidade($cidade);
        } else {
            $Salao->setCidade(null);
        }

        if ($latitude != "") {
            $Salao->setLatitude($latitude);
        } else {
            $Salao->setLatitude(null);
        }

        if ($longitude != null) {
            $Salao->setLongitude($longitude);
        } else {
            $Salao->setLongitude($longitude);
        }

        $retornoSalao = $Salao->buscaSalao($kilometro, $idLogin, $pagina, $qtRegistro);
        if (sizeof($retornoSalao) > 0) {
            echo json_encode($retornoSalao);
        } else {
            header('HTTP/1.1 400 1'); //não encontrado
            exit(0);
        }

    }

    public function visualizarSalao($request)
    {
        $idSalao = $request->getAttribute('id');
        $Salao = new Salao();
        $Salao->setIdSalao($idSalao);
        $retornoSalao = $Salao->get_salao_idSalao();
        if (sizeof($retornoSalao) > 0) {
            $saida['salao'] = $retornoSalao;
            //------- pega o gerente do salão
            $Usuario = new Usuario();
            $Usuario->setIdUsuario($retornoSalao[0]->idUsuario);
            $retornoUsuario = $Usuario->get_usuario_Id();
            if (sizeof($retornoUsuario) > 0) {
                $saida['gerente'] = $retornoUsuario;
            } else {
                $ger = new Usuario();
                $saida['gerente'] = $ger;
            }
            //---------------------------------

            //----------pega os funcionarios do salão---------------
            $funcionario = new Funcionario();
            $funcionario->setIdSalao($idSalao);
            $retornoFuncionario = $funcionario->consult_funcionarios_idSalao();
            if (sizeof($retornoFuncionario) > 0) {
                $saida['funcionarios'] = $retornoFuncionario;
            } else {
                $funcio = new Funcionario();
                $saida['funcionarios'] = array($funcio);
            }
            //-------------------------------------------------

            //------pega os serviços do salão-----------
            $Servico = new ServicosSalao();
            $Servico->setIdSalao($idSalao);
            $retornoServico = $Servico->consult_servicos_idSalao();
            if (sizeof($retornoServico) > 0) {
                $saida['servicos'] = $retornoServico;
            } else {
                $serv = new ServicosSalao();
                $saida['servicos'] = array($serv);
            }
            //-----------------------------------------
        } else {
            $saida['salao'] = "";
            $saida['funcionarios'] = "";
            $saida['servicos'] = "";
            $saida['gerente'] = "";
        }
        echo json_encode($saida);
    }

}
