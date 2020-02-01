<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class ServicosSalaoModel
{

    protected $idServicoSalao;
    protected $idSalao;
    protected $servico;
    protected $sexo;
    protected $valor;
    protected $tempo;

    protected function consult_todos_servicos()
    {
        $query = "SELECT * FROM servicos_salao";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_servicos_idSalao()
    {
        $query = "SELECT * FROM servicos_salao WHERE idSalao ='" . $this->idSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_servicos_idsServico($ids)
    {
        $query = "SELECT * FROM servicos_salao WHERE idServicoSalao IN (" . $ids . ")";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_servicosSalao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO servicos_salao ( idSalao, servico,tempo, sexo, valor) VALUES (:idSalao,:servico,:tempo, :sexo, :valor)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idSalao", $this->idSalao);
        $stmt->bindParam("servico", $this->servico);
        $stmt->bindParam("sexo", $this->sexo);
        $stmt->bindParam("valor", $this->valor);
        $stmt->bindParam("tempo", $this->tempo);
        return $stmt->execute();
    }

    protected function alt_servicosSalao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE servicos_salao SET servico=:servico,tempo=:tempo, sexo=:sexo, valor=:valor WHERE idServicoSalao=:idServicoSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idServicoSalao", $this->idServicoSalao);
        $stmt->bindParam("servico", $this->servico);
        $stmt->bindParam("sexo", $this->sexo);
        $stmt->bindParam("valor", $this->valor);
        $stmt->bindParam("tempo", $this->tempo);
        return $stmt->execute();
    }

    protected function exc_servicosSalao()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM servicos_salao WHERE idServicoSalao=:idServicoSalao";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idServicoSalao", $this->idServicoSalao);
        return $stmt->execute();
    }

}
