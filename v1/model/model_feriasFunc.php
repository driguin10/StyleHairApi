<?php
include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
class FeriasFuncModel
{

    protected $idFeriasFunc;
    protected $idFuncionario;
    protected $dataIni;
    protected $dataFim;

    protected function consult_todos()
    {
        $query = "SELECT * FROM ferias_func";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_id()
    {
        $query = "SELECT * FROM ferias_func WHERE idFeriasFunc='" . $this->idFeriasFunc . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_feriasFunc()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO ferias_func (idFuncionario, dataIni, dataFim) VALUES (:idFuncionario, :dataIni, :dataFim)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFuncionario", $this->idFuncionario);
        $stmt->bindParam("dataIni", $this->dataIni);
        $stmt->bindParam("dataFim", $this->dataFim);
        return $stmt->execute();

    }

    protected function alt_feriasFunc()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE ferias_func SET dataIni=:dataIni, dataFim=:dataFim WHERE idFeriasFunc=:idFeriasFunc";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFeriasFunc", $this->idFeriasFunc);
        $stmt->bindParam("dataIni", $this->dataIni);
        $stmt->bindParam("dataFim", $this->dataFim);
        return $stmt->execute();
    }

    protected function exc_feriasFunc()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM ferias_func WHERE idFeriasFunc=:idFeriasFunc";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFeriasFunc", $this->idFeriasFunc);
        return $stmt->execute();
    }

}
