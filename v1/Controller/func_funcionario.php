<?php
include_once 'Controller_funcionarios.php';
include_once 'Controller_usuario.php';
include_once 'Controller_login.php';

class FuncFuncionario
{
    public function salvar($request)
    {
        $TipoSalvar = $request->getParam('TipoSalvar');
        $id_Salao = $request->getParam('idSalao');
        if ($TipoSalvar == "" && $id_Salao == "") {
            $saida['id'] = "-1#-1";
            echo json_encode($saida);
        } else {
            if ($TipoSalvar == "1") //tem Login e usuario -- retorna idFuncionario
            {
                $id_Usuario = $request->getParam('idUsuario');
                $funcionario = new Funcionario();
                $funcionario->setIdUsuario($id_Usuario);
                $retornoFuncionario = $funcionario->consult_funcionarios_idUsuario();
                if (sizeof($retornoFuncionario) > 0) {
                    header('HTTP/1.1 400 08'); //usuario já é um funcionario
                    exit(0);
                } else {
                    $criarFuncionario = $this->criarFuncionario($id_Salao, $id_Usuario);
                    if ($criarFuncionario != "") {
                        $saida['id'] = $criarFuncionario;
                        echo json_encode($saida);
                    } else {
                        $saida['id'] = "";
                        echo json_encode($saida);
                    }
                }
            } //fim tipo 1

            else
            if ($TipoSalvar == "2") //tem login --retorna usuario-funcionario
            {
                $Upload_file = $request->getParam('uploaded_file');
                $Mine_file = $request->getParam('mine_file');
                $id_Login = $request->getParam('idLogin');
                $Nome = $request->getParam('nome');
                $Apelido = $request->getParam('apelido');
                $Sexo = $request->getParam('sexo');
                $data_Nascimento = explode("-", $request->getParam('dataNascimento'));
                $Telefone = $request->getParam('telefone');
                $Cep = $request->getParam('cep');
                $Endereco = $request->getParam('endereco');
                $Numero = $request->getParam('numero');
                $Bairro = $request->getParam('bairro');
                $Estado = $request->getParam('estado');
                $Cidade = $request->getParam('cidade');
                $Obs = $request->getParam('obs');
                if ($id_Login == "" && $Nome == "" && $Telefone == "" && $Estado == "" && $Cidade == "") {
                    $saida['id'] = "-1#-1";
                    echo json_encode($saida);
                } else {
                    $criarUser = $this->criarUsuario($Upload_file, $Mine_file, $id_Login, $Nome, $Apelido, $Sexo, $data_Nascimento, $Telefone, $Cep, $Endereco, $Numero, $Bairro, $Estado, $Cidade, $Obs);

                    if ($criarUser != "") {
                        $id_Usuario = $criarUser;
                        $criaFuncionario = $this->criarFuncionario($id_Salao, $id_Usuario);
                        if ($criaFuncionario != "") {
                            $saida['id'] = $id_Usuario . "#" . $criaFuncionario;
                            echo json_encode($saida);
                        } else {
                            $saida['id'] = "-1#-1";
                            echo json_encode($saida);
                        }
                    } else {
                        $saida['id'] = "-1#-1";
                        echo json_encode($saida);
                    }
                }
            } //fim tipo 2
            else {
                $email = $request->getParam('email');
                $senha = base64_encode($request->getParam('senha'));
                if ($email == "" && $senha == "") {
                    $saida['id'] = "-1#-1";
                    echo json_encode($saida);
                } else {
                    $getUsuario = new Login();
                    $getUsuario->setEmail($email);
                    $retornNewUser = $getUsuario->ver_email();
                    if (sizeof($retornNewUser) > 0) {
                        header('HTTP/1.1 400 09'); //usuario já é um funcionario
                        exit(0);
                    } else {
                        $retornoLogin = $this->criarLogin($email, $senha);
                        if ($retornoLogin != "" || $retornoLogin != "-1") {
                            $Upload_file = $request->getParam('uploaded_file');
                            $Mine_file = $request->getParam('mine_file');
                            $id_Login = $retornoLogin;
                            $Nome = $request->getParam('nome');
                            $Apelido = $request->getParam('apelido');
                            $Sexo = $request->getParam('sexo');
                            $data_Nascimento = explode("-", $request->getParam('dataNascimento'));
                            $Telefone = $request->getParam('telefone');
                            $Cep = $request->getParam('cep');
                            $Endereco = $request->getParam('endereco');
                            $Numero = $request->getParam('numero');
                            $Bairro = $request->getParam('bairro');
                            $Estado = $request->getParam('estado');
                            $Cidade = $request->getParam('cidade');
                            $Obs = $request->getParam('obs');
                            if ($id_Login == "" && $Nome == "" && $Telefone == "" && $Estado == "" && $Cidade == "") {
                                $saida['id'] = "-1#-1";
                                echo json_encode($saida);
                            }
                            $criarUser = $this->criarUsuario($Upload_file, $Mine_file, $id_Login, $Nome, $Apelido, $Sexo, $data_Nascimento, $Telefone, $Cep, $Endereco, $Numero, $Bairro, $Estado, $Cidade, $Obs);
                            if ($criarUser != "") {
                                $id_Usuario = $criarUser;
                                $criaFuncionario = $this->criarFuncionario($id_Salao, $id_Usuario);
                                if ($criaFuncionario != "") {
                                    $saida['id'] = $id_Usuario . "#" . $criaFuncionario;
                                    echo json_encode($saida);
                                } else {
                                    $saida['id'] = "-1#-1";
                                    echo json_encode($saida);
                                }
                            } else {
                                $saida['id'] = "-1#-1";
                                echo json_encode($saida);
                            }
                        } else {
                            $saida['id'] = "-2#-1";
                            echo json_encode($saida);
                        }
                    }

                }
            } //fim tipo 3
        }
    }

    public function criarLogin($Email, $Senha)
    {
        $email = $Email;
        $senha = $Senha;
        $login = new Login();
        $login->setEmail($email);
        $login->setSenha($senha);
        $consulta = $login->ver_email();
        if (sizeof($consulta) > 0) {
            return "-1";
        } else {
            $retornoLogin = $login->sav_login();
            if ($retornoLogin) {
                $retornoLogin2 = $login->consult_usuario_senha();
                if (sizeof($retornoLogin2) > 0) {
                    return $retornoLogin2[0]->idLogin;
                } else {
                    return "";
                }

            } else {
                return "";
            }

        }

    }

    public function criarUsuario($Upload_file, $Mine_file, $id_Login, $Nome, $Apelido, $Sexo, $data_Nascimento, $Telefone, $Cep, $Endereco, $Numero, $Bairro, $Estado, $Cidade, $Obs)
    {
        $file_path = "v1/imagensApp/";
        $pathImagem = "";

        if ($Upload_file != "") {
            $imgName = 'img-' . md5(microtime()) . '.' . $Mine_file;
            $binary = base64_decode($Upload_file);

            if ($file = fopen($file_path . $imgName, 'wb')) {
                if (fwrite($file, $binary)) {
                    $pathImagem = $file_path . $imgName;
                }
            }
        }

        $idLogin = $id_Login;
        $nome = $Nome;
        $apelido = $Apelido;
        $sexo = $Sexo;
        $dataNascimento = explode("-", $data_Nascimento);
        $telefone = $Telefone;
        $cep = $Cep;
        $endereco = $Endereco;
        $numero = $Numero;
        $bairro = $Bairro;
        $estado = $Estado;
        $cidade = $Cidade;
        $obs = $Obs;

        $dataNascimento = $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0];
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
            $retornoUsuario2 = $Usuario->get_usuario();
            if (sizeof($retornoUsuario2) > 0) {
                return $retornoUsuario2[0]->idUsuario;
            } else {
                return "";
            }

        } else {
            return "";
        }

    }

//criar funcionario ------
    public function criarFuncionario($id_Salao, $id_Usuario)
    {
        $idSalao = $id_Salao;
        $idUsuario = $id_Usuario;
        $entradaPadrao = "09:00";
        $saidaPadrao = "19:00";
        $padraoFolga = null;
        $padraoAlmocoIni = null;
        $padraoAlmocoFim = null;
        $Funcionario = new Funcionario();
        $Funcionario->setIdSalao($idSalao);
        $Funcionario->setIdUsuario($idUsuario);
        $Funcionario->setSegE($entradaPadrao);
        $Funcionario->setSegS($saidaPadrao);
        $Funcionario->setTerE($entradaPadrao);
        $Funcionario->setTerS($saidaPadrao);
        $Funcionario->setQuaE($entradaPadrao);
        $Funcionario->setQuaS($saidaPadrao);
        $Funcionario->setQuiE($entradaPadrao);
        $Funcionario->setQuiS($saidaPadrao);
        $Funcionario->setSexE($entradaPadrao);
        $Funcionario->setSexS($saidaPadrao);
        $Funcionario->setSabE($entradaPadrao);
        $Funcionario->setSabS($saidaPadrao);
        $Funcionario->setDomE($padraoFolga);
        $Funcionario->setDomS($padraoFolga);
        $Funcionario->setAlmocoIni($padraoAlmocoIni);
        $Funcionario->setAlmocoFim($padraoAlmocoFim);
        $retornoFuncionario = $Funcionario->sav_funcionario();
        if ($retornoFuncionario) {
            $retornoFuncionario2 = $Funcionario->consult_funcionarios_idUsuario();
            if (sizeof($retornoFuncionario2) > 0) {
                return $retornoFuncionario2[0]->idFuncionario;
            } else {
                return "";
            }
        } else {
            return "";
        }

    }

    public function editar($request)
    {
        $idFuncionario = $request->getParam('idFuncionario');
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
        $almocoIni = $request->getParam('almocoIni');
        $almocoFim = $request->getParam('almocoFim');

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

        if ($almocoIni == "") {
            $almocoIni = $padraoAlmocoIni;
        }

        if ($almocoFim == "") {
            $almocoFim = $padraoAlmocoFim;
        }

        if ($idFuncionario != "") {
            $Funcionario = new Funcionario();
            $Funcionario->setIdFuncionario($idFuncionario);
            $Funcionario->setSegE($SegE);
            $Funcionario->setSegS($SegS);
            $Funcionario->setTerE($TerE);
            $Funcionario->setTerS($TerS);
            $Funcionario->setQuaE($QuaE);
            $Funcionario->setQuaS($QuaS);
            $Funcionario->setQuiE($QuiE);
            $Funcionario->setQuiS($QuiS);
            $Funcionario->setSexE($SexE);
            $Funcionario->setSexS($SexS);
            $Funcionario->setSabE($SabE);
            $Funcionario->setSabS($SabS);
            $Funcionario->setDomE($DomE);
            $Funcionario->setDomS($DomS);
            $Funcionario->setAlmocoIni($almocoIni);
            $Funcionario->setAlmocoFim($almocoFim);
            $retornoFuncionario = $Funcionario->alt_funcionario();
            if ($retornoFuncionario) {
                header('HTTP/1.1 204 01'); // salvo
                exit(0);
            } else {
                header('HTTP/1.1 400 04'); // erro ao salvar
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // parametros incorretos
            exit(0);
        }
    }

    public function deletar($request)
    {
        $idFuncionario = $request->getAttribute('id');

        if ($idFuncionario != "") {
            $Funcionario = new Funcionario();
            $Funcionario->setIdFuncionario($idFuncionario);
            $retornoFuncionario = $Funcionario->exc_funcionario();
            if ($retornoFuncionario) {
                header('HTTP/1.1 204 01'); // excluido
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // erro ao excluir
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // parametros incorretos
            exit(0);
        }
    }

    public function deletar_idUsuario($request)
    {
        $idUsuario = $request->getAttribute('id');

        if ($idUsuario != "") {
            $Funcionario = new Funcionario();
            $Funcionario->setIdUsuario($idUsuario);
            $retornoFuncionario = $Funcionario->exc_funcionario_idUsuario();
            if ($retornoFuncionario) {
                header('HTTP/1.1 204 01'); // excluido
                exit(0);
            } else {
                header('HTTP/1.1 400 05'); // erro ao excluir
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 02'); // parametros incorretos
            exit(0);
        }
    }

    public function get_funcionarios($request)
    {
        $idSalao = $request->getAttribute('id');

        if ($idSalao != "") {
            $funcionario = new Funcionario();
            $funcionario->setIdSalao($idSalao);
            $retornoFuncionario = $funcionario->consult_funcionarios_idSalao();
            if (sizeof($retornoFuncionario) > 0) {
                header('HTTP/1.1 200 01');
                $saida['funcionarios'] = $retornoFuncionario;
                echo json_encode($saida);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function get_funcionario($request)
    {
        $idFuncionario = $request->getAttribute('id');

        if ($idFuncionario != "") {
            $funcionario = new Funcionario();
            $funcionario->setIdFuncionario($idFuncionario);
            $retornoFuncionario = $funcionario->consult_funcionarios_idFuncionario();
            if (sizeof($retornoFuncionario) > 0) {
                header('HTTP/1.1 200 01');
                echo json_encode($retornoFuncionario);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function get_funcionario_busca($request)
    {
        $idSalao = $request->getAttribute('id');
        $idServicos = $request->getAttribute('idServ');

        if ($idSalao != "" && $idServicos != "") {
            $funcionario = new Funcionario();
            $funcionario->setIdSalao($idSalao);
            $retornoFuncionario = $funcionario->consult_funcionarios_busca($idServicos);
            if (sizeof($retornoFuncionario) > 0) {
                header('HTTP/1.1 200 01');
                $saida['funcionarios'] = $retornoFuncionario;
                echo json_encode($saida);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function FeriasFuncionario($request)
    {
        $idFuncionario = $request->getParam('idFuncionario');
        $feriasIni = $request->getParam('feriasIni');
        $feriasFim = $request->getParam('feriasFim');

        if ($feriasIni == "") {
            $feriasIni = null;
        } else {
            $feriasIniAux = explode("-", $feriasIni);
            $feriasIni = $feriasIniAux[2] . "-" . $feriasIniAux[1] . "-" . $feriasIniAux[0];
        }

        if ($feriasFim == "") {
            $feriasFim = null;
        } else {
            $feriasFimAux = explode("-", $feriasFim);
            $feriasFim = $feriasFimAux[2] . "-" . $feriasFimAux[1] . "-" . $feriasFimAux[0];
        }

        if ($idFuncionario != "") {
            $funcionario = new Funcionario();
            $funcionario->setIdFuncionario($idFuncionario);
            $funcionario->setFeriasIni($feriasIni);
            $funcionario->setFeriasFim($feriasFim);
            $retornoFuncionario = $funcionario->feriasFuncionario();
            if ($retornoFuncionario) {
                header('HTTP/1.1 200 01');
                exit(0);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

    public function getFerias($request)
    {
        $idFuncionario = $request->getAttribute('idFuncionario');

        if ($idFuncionario != "") {
            $funcionario = new Funcionario();
            $funcionario->setIdFuncionario($idFuncionario);
            $retornoFuncionario = $funcionario->consult_feriasFuncionario();
            if (sizeof($retornoFuncionario) > 0) {
                header('HTTP/1.1 200 01');
                $saida['feriasIni'] = $retornoFuncionario[0]->feriasIni;
                $saida['feriasFim'] = $retornoFuncionario[0]->feriasFim;
                echo json_encode($saida);
            } else {
                header('HTTP/1.1 400 1'); //não encontrado
                exit(0);
            }
        } else {
            header('HTTP/1.1 400 2'); //paramentros incorretos
            exit(0);
        }
    }

} //fim da classe
