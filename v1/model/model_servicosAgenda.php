<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class ServicosAgendaModel
{

    protected $idServicoAgenda;
    protected $idAgenda;
    protected $idServicoSalao;

    protected function consult_todos_sevicos()
    {
        $query = "SELECT * FROM servicos_agenda";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_sevicos_agenda()
    {
        $query = "SELECT servSalao.servico, servSalao.tempo , servSalao.valor  FROM servicos_salao AS servSalao
								INNER JOIN servicos_agenda AS servAgend ON servAgend.idAgenda = " . $this->idAgenda . "
								WHERE servSalao.idServicoSalao = servAgend.idServicoSalao";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_servicoAgenda($values)
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO servicos_agenda (idAgenda, idServicoSalao) VALUES $values";
        $stmt = $conexao->prepare($query);
        return $stmt->execute();
    }

    protected function exc_servicoAgenda()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM servicos_agenda WHERE idServicoAgenda=:idServicoAgenda";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idServicoAgenda", $this->idServicoAgenda);
        return $stmt->execute();
    }

}
