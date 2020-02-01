<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class AgendaModel
{

    protected $idAgenda;
    protected $idSalao;
    protected $idFuncionario;
    protected $idUsuario;
    protected $data;
    protected $horaIni;
    protected $horaFim;
    protected $status;

    protected function consult_all()
    {
        $query = "SELECT * FROM agenda";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_id_agenda()
    {
        $query = "SELECT * FROM agenda WHERE idAgenda='" . $this->idAgenda . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_id_func()
    {
        $query = "SELECT a.idAgenda AS idAgenda, u.nome AS nome, u.linkImagem AS imagem, a.idUsuario AS idUsuario, a.data AS data, a.horaIni AS horaIni, a.horaFim AS horaFim, a.status AS status
					FROM agenda AS a
					INNER JOIN usuarios AS u ON u.idUsuario = a.idUsuario
					WHERE idFuncionario ='" . $this->idFuncionario . "'
					AND data ='" . $this->data . "' ORDER BY horaIni";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_id_user()
    {
        $query = "SELECT a.idAgenda AS idAgenda, s.nome AS nome, s.linkImagem AS imagem,
					s.endereco As endereco,s.numero AS numero, s.bairro AS bairro,s.cidade AS cidade,
					s.complemento AS complemento, s.estado As estado,
					a.idUsuario AS  idUsuario, a.data AS data, a.horaIni AS horaIni,
					a.horaFim AS horaFim, a.status AS status , a.idFuncionario AS idFuncionario, u.nome AS nomeFuncionario, u.linkImagem AS imagemFuncionario
					FROM agenda AS a
					LEFT JOIN saloes AS s ON s.idSalao = a.idSalao
          LEFT JOIN funcionarios AS f ON f.idFuncionario = a.idFuncionario
          LEFT JOIN usuarios AS u ON u.idUsuario = f.idUsuario
					WHERE a.idUsuario ='" . $this->idUsuario . "'
					AND data ='" . $this->data . "' ORDER BY horaIni";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_agenda()
    {
        $query = "INSERT INTO agenda (idSalao, idFuncionario, idUsuario, data, horaIni, horaFim,status)
    	 VALUES ('" . $this->idSalao . "','" . $this->idFuncionario . "','" . $this->idUsuario . "','"
        . $this->data . "','" . $this->horaIni . "','" . $this->horaFim . "','" . $this->status . "')";
        return Dao::getInstancia()->executeSelect2($query);
    }

    protected function alt_status()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status=:status WHERE idAgenda=:idAgenda";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idAgenda", $this->idAgenda);
        $stmt->bindParam("status", $this->status);
        return $stmt->execute();
    }

    protected function alt_todos_status()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status=:status WHERE idUsuario=:idUsuario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idUsuario", $this->idUsuario);
        $stmt->bindParam("status", $this->status);
        return $stmt->execute();
    }

    protected function alt_status_func()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE agenda SET status=:status WHERE idFuncionario=:idFuncionario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFuncionario", $this->idFuncionario);
        $stmt->bindParam("status", $this->status);
        return $stmt->execute();
    }

    protected function exc_agenda()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM agenda WHERE idAgenda=:idAgenda";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idAgenda", $this->idAgenda);
        return $stmt->execute();
    }

}
