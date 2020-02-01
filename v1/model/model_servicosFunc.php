<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class ServicosFuncModel
{

    protected $idServicoFunc;
    protected $idFuncionario;
    protected $idServicoSalao;

    protected function consult_all()
    {
        $query = "SELECT * FROM servicos_func";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_idFunc()
    {
        $query = "SELECT * FROM servicos_func WHERE idFuncionario ='" . $this->idFuncionario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_idFunc_idServ()
    {
        $query = "SELECT * FROM servicos_func WHERE idFuncionario ='" . $this->idFuncionario . "' AND idServicoSalao = '" . $this->idServicoSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_servicos_func()
    {
        $query = "SELECT servicos_func.idServicoFunc AS 'idServicoSalao',
			servicos_salao.idSalao AS 'idSalao', servicos_salao.servico AS 'servico',
			servicos_salao.tempo AS 'tempo', servicos_salao.sexo AS 'sexo',
			servicos_salao.valor AS 'valor' FROM	servicos_salao
			INNER JOIN servicos_func ON servicos_salao.idServicoSalao = servicos_func.idServicoSalao
			WHERE	servicos_func.idFuncionario ='" . $this->idFuncionario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_servicoFunc()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO servicos_func ( idFuncionario, IdServicoSalao) VALUES (:idFuncionario, :idServicoSalao)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFuncionario", $this->idFuncionario);
        $stmt->bindParam("idServicoSalao", $this->idServicoSalao);
        return $stmt->execute();
    }

    protected function alt_servicoFunc()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE servicos_func SET idServicoSalao=:idServicoSalao WHERE idServicoFunc=:idServicoFunc";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idServicoFunc", $this->idServicoFunc);
        $stmt->bindParam("idServicoSalao", $this->idServicoSalao);
        return $stmt->execute();
    }

    protected function exc_servicoFunc()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM servicos_func WHERE idServicoFunc=:idServicoFunc";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idServicoFunc", $this->idServicoFunc);
        return $stmt->execute();
    }

}
