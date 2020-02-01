<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_excluir_contas.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_excluir_contas.php', dirname(__FILE__));
}

class Excluir extends ExcluirModel
{

    public function exc_usuario_comum($idLogin)
    {
        return parent::exc_usuario_comum($idLogin);
    }

    public function exc_usuario($idLogin, $idUsuario)
    {
        return parent::exc_usuario($idLogin, $idUsuario);
    }

    public function exc_funcionario($idLogin, $idUsuario, $funcionario)
    {
        return parent::exc_funcionario($idLogin, $idUsuario, $funcionario);
    }

    public function exc_gerente($idLogin, $idUsuario, $funcionario, $idSalao)
    {
        return parent::exc_gerente($idLogin, $idUsuario, $funcionario, $idSalao);
    }

    public function exc_gerente_login($idUsuario, $funcionario, $idSalao)
    {
        return parent::exc_gerente_login($idUsuario, $funcionario, $idSalao);
    }

}
