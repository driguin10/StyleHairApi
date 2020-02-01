<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class ExcluirModel
{

    protected function exc_usuario_comum($idLogin)
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM login WHERE idLogin = :idLogin;
								DELETE FROM saloes_favoritos WHERE saloes_favoritos.idLogin=:idLogin;";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idLogin", $idLogin);
        return $stmt->execute();
    }

    protected function exc_usuario($idLogin, $idUsuario)
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status='0' WHERE idUsuario=:idUsuario;
								DELETE FROM login WHERE idLogin = :idLogin;
								DELETE FROM saloes_favoritos WHERE saloes_favoritos.idLogin=:idLogin;
								DELETE FROM usuarios WHERE usuarios.idLogin=:idLogin;";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idLogin", $idLogin);
        $stmt->bindParam("idUsuario", $idUsuario);
        return $stmt->execute();
    }

    protected function exc_funcionario($idLogin, $idUsuario, $funcionario)
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status='0' WHERE idUsuario= :idUsuario;
								UPDATE agenda SET status='0' WHERE idFuncionario=:funcionario;
								DELETE FROM login WHERE idLogin = :idLogin;
								DELETE FROM usuarios WHERE usuarios.idLogin=:idLogin;
								DELETE FROM saloes_favoritos WHERE saloes_favoritos.idLogin=:idLogin;
								DELETE FROM servicos_func WHERE servicos_func.idFuncionario = :funcionario;
								DELETE FROM funcionarios WHERE funcionarios.idFuncionario =:funcionario;";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idLogin", $idLogin);
        $stmt->bindParam("idUsuario", $idUsuario);
        $stmt->bindParam("funcionario", $funcionario);
        return $stmt->execute();
    }

    protected function exc_gerente($idLogin, $idUsuario, $idfuncionario, $idSalao)
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status='3' WHERE idUsuario= :idUsuario;
								DELETE FROM login WHERE idLogin = :idLogin;
								DELETE FROM usuarios WHERE usuarios.idLogin=:idLogin;
								DELETE FROM saloes_favoritos WHERE saloes_favoritos.idLogin=:idLogin;
								DELETE FROM servicos_func WHERE servicos_func.idFuncionario = :idfuncionario;
								DELETE FROM funcionarios WHERE funcionarios.idSalao =:idSalao;
								DELETE FROM saloes WHERE saloes.idSalao =:idSalao;";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idLogin", $idLogin);
        $stmt->bindParam("idUsuario", $idUsuario);
        $stmt->bindParam("idfuncionario", $idfuncionario);
        $stmt->bindParam("idSalao", $idSalao);
        return $stmt->execute();
    }

    protected function exc_gerente_login($idUsuario, $idfuncionario, $idSalao)
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status='3' WHERE idUsuario= :idUsuario;
								DELETE FROM servicos_func WHERE servicos_func.idFuncionario = :idfuncionario;
								DELETE FROM funcionarios WHERE funcionarios.idSalao =:idSalao;
								DELETE FROM saloes WHERE saloes.idSalao =:idSalao;";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idUsuario", $idUsuario);
        $stmt->bindParam("idfuncionario", $idfuncionario);
        $stmt->bindParam("idSalao", $idSalao);
        return $stmt->execute();
    }

}
