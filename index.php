<?php

require 'vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$API_container = new \Slim\Container($configuration); //Cria um container
$API_container['notFoundHandler'] = function ($c) { //substitui a pagina de nao encontrado
    return function ($request, $response) use ($c) {
        return $c['response']->withStatus(404)->withHeader('Content-Type', 'text/html')
            ->write('Recurso não encontrada');
    };
};

$app = new \Slim\App($API_container); // instancia um novo app

function acesso($request, $controller) // verifica a chave de acesso
{
    include_once $request->getAttribute('versao') . "/Conexao/autenticacao.php";
    include_once $request->getAttribute('versao') . "/Controller/" . $controller;
    $aut = new autenticacao();
    if (!$aut->autentic($request)) {
        header('HTTP/1.1 401 01');
        echo "401 não autorizado";
        exit(0);
    }
}

//***************** ROTAS **************************************************************

//-----outra aplicação---------------------------------------------------
$app->get('/gerarHash/{serial}', function ($request, $response, $args) {
    include_once ("v1/Controller/gerarHash.php");
    $serial = new GerarSerial();
    $serial->gerar($request);
});
//----------------------------------------------------------------------

//----------------caminho inicial-------------------
$app->get('/', function ($request, $response) {
    $response->getBody()->write("Bem vindo a Api StyleHair !!");
    return $response;
});
//--------------------------------------------------

$app->get('/download', function ($request, $response, $args) {
    echo '<meta http-equiv="refresh" content="1; url=/v1/download/StyleHair.apk">';
    echo "<h1>Obrigado por efetuar o download...</h1>";
});



$app->get('/bitrix', function ($request, $response, $args) {
    echo 'bitrix ok';
   
});

//************************ LOGIN (USUARIO E SENHA) **************************************

// verifica se existe usuario e senha
$app->post('/{versao}/logins/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->Logar($request);
});

// cria o acesso ao app, usuario e senha e apiKey
$app->post('/{versao}/logins/salvar/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->salvar($request);
});

// altera o email ou a senha
$app->post('/{versao}/logins/editar/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->alterar($request);
});

//requisita uma senha para redefinição de senha
$app->post('/{versao}/logins/reset/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->resetSenha($request);
});

//altera a senha apos solicitar senha de redefinição
$app->post('/{versao}/logins/editarSenha/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->alterarSenha($request);
});

//********************** USUARIO ***************************************************

// salva o usuario
$app->post('/{versao}/usuarios/salvar/', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->salvar($request);
});

//cria um usuario anonimo para efetuar um agendamento-- nome-telefone
$app->post('/{versao}/usuarios/anonimo/salvar/', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->userAnonimo($request);
});

// deleta usuario anonimo
$app->delete('/{versao}/usuarios/anonimo/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->deletarAnonimo($request);
});

// edita usuario
$app->post('/{versao}/usuarios/editar/', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->editar($request);
});

// deletar usuario
$app->delete('/{versao}/usuarios/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->deletar($request);
});

//pegar usuario
$app->get('/{versao}/usuarios/{id}', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->get_usuario($request);
});

//pegar usuario id usuario
$app->get('/{versao}/usuariosId/{id}', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->get_usuario_id($request);
});

//pegar tipo usuario
$app->get('/{versao}/usuarios/tipos/{id}', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->tipoUsuario($request);
});

//criar login
$app->post('/{versao}/usuarios/criarLoginUser/', function ($request, $response, $args) {
    acesso($request, "func_usuario.php");
    $usuario = new FuncUsuario();
    $usuario->criarLoginUsuario($request);
});

//********************** SALOES ***************************************************
// salva o salao
$app->post('/{versao}/saloes/salvar/', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->salvar($request);
});

// edita salao
$app->post('/{versao}/saloes/editar/', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->editar($request);
});

//trocar gerente do salao
$app->post('/{versao}/saloes/trocarGerente/', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->trocarGerencia($request);
});

// edita status do salao
$app->post('/{versao}/saloes/editarStatus/', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->editar_status($request);
});

// deletar salao
$app->delete('/{versao}/saloes/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->deletar($request);
});

//pegar salao pelo id do usuario
$app->get('/{versao}/saloes/{id}', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->get_salao($request);
});

//pegar salao pelo id do salao
$app->get('/{versao}/saloes/idSalao/{id}', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->get_salao_idSalao($request);
});

// altera configurações do salao
$app->post('/{versao}/saloes/configuracoes/', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->configuracoes($request);
});

// busca salao
$app->post('/{versao}/saloes/', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->buscarSalao($request);
});

// busca dados do salão
$app->get('/{versao}/saloes/salao/{id}', function ($request, $response, $args) {
    acesso($request, "func_saloes.php");
    $salao = new FuncSaloes();
    $salao->visualizarSalao($request);
});

//********************** FUNCIONARIOS ***************************************************

//transforma usuario em funcionario
$app->post('/{versao}/logins/funcionario/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->usuarioPfuncionario($request);
});

//transforma usuario para gerente
$app->post('/{versao}/logins/novoGerente/', function ($request, $response, $args) {
    acesso($request, "func_login.php");
    $log = new FuncLogin();
    $log->usuarioPgerente($request);
});

//criar funcionario
$app->post('/{versao}/funcionarios/salvar/', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->salvar($request);
});

//editar funcionario
$app->post('/{versao}/funcionarios/editar/', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->editar($request);
});

//deletar funcionario
$app->get('/{versao}/funcionarios/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->deletar($request);
});

//deletar funcionario pelo id de usuario
$app->get('/{versao}/funcionarios/deletar/usuario/{id}', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->deletar_idUsuario($request);
});

//pegar funcionarios do salao
$app->get('/{versao}/funcionarios/{id}', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->get_funcionarios($request);
});

//busca funcionarios que faz determinado serviços(tela de agendamento)
$app->get('/{versao}/funcionarios/salao/{id}/servicos/{idServ}', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->get_funcionario_busca($request);
});

//pegar só um funcionario pelo id
$app->get('/{versao}/funcionarios/funcionario/{id}', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->get_funcionario($request);
});

//alterar ferias do funcionario
$app->post('/{versao}/funcionarios/ferias/', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->FeriasFuncionario($request);
});

//buscar ferias do funcionario
$app->get('/{versao}/funcionarios/ferias/{idFuncionario}', function ($request, $response, $args) {
    acesso($request, "func_funcionario.php");
    $funcionario = new FuncFuncionario();
    $funcionario->getFerias($request);
});

//********************** SERVIÇOS DO SALÃO ***************************************************
$app->post('/{versao}/servi_saloes/salvar/', function ($request, $response, $args) {
    acesso($request, "func_servicosSalao.php");
    $servicoSalao = new FuncServicoSalao();
    $servicoSalao->salvar($request);
});

$app->post('/{versao}/servi_saloes/editar/', function ($request, $response, $args) {
    acesso($request, "func_servicosSalao.php");
    $servicoSalao = new FuncServicoSalao();
    $servicoSalao->editar($request);
});

$app->get('/{versao}/servi_saloes/servicos/{id}', function ($request, $response, $args) {
    acesso($request, "func_servicosSalao.php");
    $servicoSalao = new FuncServicoSalao();
    $servicoSalao->get_servico_salao($request);
});

$app->get('/{versao}/servi_saloes/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_servicosSalao.php");
    $usuario = new FuncServicoSalao();
    $usuario->deletar($request);
});

//----------------------- SERVIÇOS DO FUNCIONARIO-----------------

$app->post('/{versao}/servi_funcionarios/salvar/', function ($request, $response, $args) {
    acesso($request, "func_servicosFunc.php");
    $servicoFuncionario = new ServicosFunc();
    $servicoFuncionario->salvar($request);
});

$app->post('/{versao}/servi_funcionarios/editar/', function ($request, $response, $args) {
    acesso($request, "func_servicosFunc.php");
    $servicoFuncionario = new ServicosFunc();
    $servicoFuncionario->editar($request);
});

$app->get('/{versao}/servi_funcionarios/servicos/{id}', function ($request, $response, $args) {
    acesso($request, "func_servicosFunc.php");
    $servicoFuncionario = new ServicosFunc();
    $servicoFuncionario->get_servicos($request);
});

$app->get('/{versao}/servi_funcionarios/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_servicosFunc.php");
    $servicoFuncionario = new ServicosFunc();
    $servicoFuncionario->deletar($request);
});
//-------------------------------------------------------------------------

//----------------------avaliacoes-----------------------------------

$app->post('/{versao}/avaliacoes/salvar/', function ($request, $response, $args) {
    acesso($request, "func_avaliacoes.php");
    $servicoFuncionario = new Avaliacoes();
    $servicoFuncionario->salvar($request);
});

$app->get('/{versao}/avaliacoes/{id}', function ($request, $response, $args) {
    acesso($request, "func_avaliacoes.php");
    $servicoFuncionario = new Avaliacoes();
    $servicoFuncionario->get_avaliacoes($request);
});

$app->get('/{versao}/avaliacoes/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_avaliacoes.php");
    $servicoFuncionario = new Avaliacoes();
    $servicoFuncionario->deletar($request);
});
$app->get('/{versao}/avaliacoes/comentario/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_avaliacoes.php");
    $servicoFuncionario = new Avaliacoes();
    $servicoFuncionario->deletarComentario($request);
});
//-------------------------------------------------------------------------------

//********************** AGENDA ***************************************************
$app->post('/{versao}/agenda/horarios/', function ($request, $response, $args) {
    acesso($request, "func_agenda.php");
    $Agenda = new Agendas();
    $Agenda->montarHorarios($request);
});

$app->post('/{versao}/agenda/salvar/', function ($request, $response, $args) {
    acesso($request, "func_agenda.php");
    $Agenda = new Agendas();
    $Agenda->salvar($request);
});

$app->get('/{versao}/agenda/{who}/{id}/{data}', function ($request, $response, $args) {
    acesso($request, "func_agenda.php");
    $Agenda = new Agendas();
    $Agenda->buscarAgendamento($request);
});

$app->get('/{versao}/agenda/status/{idAgenda}/{status}/', function ($request, $response, $args) {
    acesso($request, "func_agenda.php");
    $Agenda = new Agendas();
    $Agenda->alterarStatus($request);
});

$app->get('/{versao}/agenda/excluir/{idAgenda}/', function ($request, $response, $args) {
    acesso($request, "func_agenda.php");
    $Agenda = new Agendas();
    $Agenda->excluirStatus($request);
});
//-----------------------------------------------------------------------------------

//--------------------------------SERVICO AGENDA-----------------------------------
$app->get('/{versao}/servicoAgenda/{id}/', function ($request, $response, $args) {
    acesso($request, "func_servicosAgenda.php");
    $ServAgenda = new FuncServicoAgenda();
    $ServAgenda->getServicosAgenda($request);
});
//-----------------------------------------------------------------------------------

//********************************** favorito ************************
$app->post('/{versao}/favorito/salvar/', function ($request, $response, $args) {
    acesso($request, "func_favorito.php");
    $Favorito = new FavoritoUser();
    $Favorito->salvar($request);
});

$app->get('/{versao}/favorito/idFav/{id}', function ($request, $response, $args) {
    acesso($request, "func_favorito.php");
    $Favorito = new FavoritoUser();
    $Favorito->get_favoritos_idFav($request);
});

$app->get('/{versao}/favorito/idLog/{id}', function ($request, $response, $args) {
    acesso($request, "func_favorito.php");
    $Favorito = new FavoritoUser();
    $Favorito->get_favoritos_idLog($request);
});

//-------- salao pega os usuarios que estao cadastrado como favorito
$app->get('/{versao}/favorito/idSal/{id}', function ($request, $response, $args) {
    acesso($request, "func_favorito.php");
    $Favorito = new FavoritoUser();
    $Favorito->get_favoritos_idSal($request);
});

$app->get('/{versao}/favorito/deletar/{id}', function ($request, $response, $args) {
    acesso($request, "func_favorito.php");
    $Favorito = new FavoritoUser();
    $Favorito->deletar($request);
});

//---------------------------------------------------------------------------------

//*************************Excluir**************************************************
$app->post('/{versao}/conta/deletar/comum/', function ($request, $response, $args) {
    acesso($request, "func_excluir_contas.php");
    $funcExcluirConta = new FuncExcluir();
    $funcExcluirConta->deletarUsuarioComum($request);
});

$app->post('/{versao}/conta/deletar/usuario/', function ($request, $response, $args) {
    acesso($request, "func_excluir_contas.php");
    $funcExcluirConta = new FuncExcluir();
    $funcExcluirConta->deletarUsuario($request);
});

$app->post('/{versao}/conta/deletar/funcionario/', function ($request, $response, $args) {
    acesso($request, "func_excluir_contas.php");
    $funcExcluirConta = new FuncExcluir();
    $funcExcluirConta->deletarFuncionario($request);
});

$app->post('/{versao}/conta/deletar/gerente/', function ($request, $response, $args) {
    acesso($request, "func_excluir_contas.php");
    $funcExcluirConta = new FuncExcluir();
    $funcExcluirConta->deletarGerente($request);
});

$app->post('/{versao}/conta/deletar/gerenteLogin/', function ($request, $response, $args) {
    acesso($request, "func_excluir_contas.php");
    $funcExcluirConta = new FuncExcluir();
    $funcExcluirConta->deletarGerenteLogin($request);
});
//---------------------------------------------------------------------------------

$app->delete('/{versao}/notificacoes/excluir/{id}', function ($request, $response, $args) {
    acesso($request, "func_notificacao.php");
    $notificacao = new Notifica();
    $notificacao->deletar($request);
});

$app->get('/{versao}/notificacoes/{id}', function ($request, $response, $args) {
    acesso($request, "func_notificacao.php");
    $notificacao = new Notifica();
    $notificacao->get_notificacoes($request);
});

$app->get('/{versao}/notificacoes/alterar/{idNotificacao}/{visualizado}', function ($request, $response, $args) {
    acesso($request, "func_notificacao.php");
    $notificacao = new Notifica();
    $notificacao->altera_notificacoes($request);
});

$app->post('/{versao}/notificacoes/enviar/', function ($request, $response, $args) {
    acesso($request, "func_notificacao.php");
    $notificacao = new Notifica();
    $notificacao->enviarNotificacao($request);
});

//************************* FIM DAS ROTAS ****************************************

$app->run();
