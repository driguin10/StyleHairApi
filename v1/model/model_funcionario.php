<?php
if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('model', 'Conexao\dao.php', dirname(__FILE__));
} else {
    include_once str_replace('model', 'Conexao/dao.php', dirname(__FILE__));
}

class FuncionarioModel
{

    protected $idFuncionario;
    protected $idSalao;
    protected $idUsuario;
    protected $SegE;
    protected $SegS;
    protected $TerE;
    protected $TerS;
    protected $QuaE;
    protected $QuaS;
    protected $QuiE;
    protected $QuiS;
    protected $SexE;
    protected $SexS;
    protected $SabE;
    protected $SabS;
    protected $DomE;
    protected $DomS;
    protected $feriasIni;
    protected $feriasFim;
    protected $almocoIni;
    protected $almocoFim;

    protected function consult_todos_funcionarios()
    {
        $query = "SELECT * FROM funcionarios";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function sav_funcionario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "INSERT INTO funcionarios (idSalao, idUsuario, segE, segS, terE, terS, quaE, quaS, quiE, quiS, sexE, sexS, sabE, sabS, domE, domS, feriasIni, feriasFim,almocoIni,almocoFim) VALUES (:idSalao, :idUsuario, :SegE, :SegS, :TerE, :TerS, :QuaE, :QuaS, :QuiE, :QuiS, :SexE, :SexS, :SabE, :SabS, :DomE, :DomS,	NULL,NULL,:almocoIni, :almocoFim )";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idSalao", $this->idSalao);
        $stmt->bindParam("idUsuario", $this->idUsuario);
        $stmt->bindParam("SegE", $this->SegE);
        $stmt->bindParam("SegS", $this->SegS);
        $stmt->bindParam("TerE", $this->TerE);
        $stmt->bindParam("TerS", $this->TerS);
        $stmt->bindParam("QuaE", $this->QuaE);
        $stmt->bindParam("QuaS", $this->QuaS);
        $stmt->bindParam("QuiE", $this->QuiE);
        $stmt->bindParam("QuiS", $this->QuiS);
        $stmt->bindParam("SexE", $this->SexE);
        $stmt->bindParam("SexS", $this->SexS);
        $stmt->bindParam("SabE", $this->SabE);
        $stmt->bindParam("SabS", $this->SabS);
        $stmt->bindParam("DomE", $this->DomE);
        $stmt->bindParam("DomS", $this->DomS);
        $stmt->bindParam("almocoIni", $this->almocoIni);
        $stmt->bindParam("almocoFim", $this->almocoFim);
        return $stmt->execute();
    }

    protected function alt_funcionario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE funcionarios SET segE=:SegE, segS=:SegS, terE=:TerE, terS=:TerS, quaE=:QuaE, quaS=:QuaS, quiE=:QuiE, quiS=:QuiS, sexE=:SexE, sexS=:SexS, sabE=:SabE,sabS=:SabS,domE=:DomE,domS=:DomS,
    	almocoIni=:almocoIni, almocoFim=:almocoFim WHERE idFuncionario=:idFuncionario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFuncionario", $this->idFuncionario);
        $stmt->bindParam("SegE", $this->SegE);
        $stmt->bindParam("SegS", $this->SegS);
        $stmt->bindParam("TerE", $this->TerE);
        $stmt->bindParam("TerS", $this->TerS);
        $stmt->bindParam("QuaE", $this->QuaE);
        $stmt->bindParam("QuaS", $this->QuaS);
        $stmt->bindParam("QuiE", $this->QuiE);
        $stmt->bindParam("QuiS", $this->QuiS);
        $stmt->bindParam("SexE", $this->SexE);
        $stmt->bindParam("SexS", $this->SexS);
        $stmt->bindParam("SabE", $this->SabE);
        $stmt->bindParam("SabS", $this->SabS);
        $stmt->bindParam("DomE", $this->DomE);
        $stmt->bindParam("DomS", $this->DomS);
        $stmt->bindParam("almocoIni", $this->almocoIni);
        $stmt->bindParam("almocoFim", $this->almocoFim);
        return $stmt->execute();
    }

    protected function exc_funcionario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM funcionarios WHERE idFuncionario=:idFuncionario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFuncionario", $this->idFuncionario);
        return $stmt->execute();
    }

    protected function exc_funcionario_idUsuario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "DELETE FROM funcionarios WHERE idUsuario=:idUsuario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idUsuario", $this->idUsuario);
        return $stmt->execute();
    }

    protected function consult_funcionarios_idUsuario()
    {
        $query = "SELECT * FROM funcionarios WHERE idUsuario='" . $this->idUsuario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_funcionarios_idFuncionario()
    {
        $query = "SELECT * FROM funcionarios WHERE idFuncionario='" . $this->idFuncionario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_funcionarios_idSalao()
    {
        $query = "SELECT u.idUsuario as idUsuario, u.nome as nome,u.linkImagem as linkImagem, f.idFuncionario as idFuncionario, u.telefone as telefone FROM usuarios as u INNER JOIN funcionarios as f ON f.idUsuario = u.idUsuario WHERE f.idSalao ='" . $this->idSalao . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function consult_funcionarios_busca($valores)
    {
        $query = "SELECT f.idFuncionario as idFuncionario, u.idUsuario as idUsuario, u.nome as nome,u.linkImagem as linkImagem, u.telefone as telefone, servS.idServicoSalao as idServico, servS.servico as servico
				FROM usuarios as u INNER JOIN funcionarios as f ON f.idUsuario = u.idUsuario
				INNER JOIN servicos_func as serv ON serv.idFuncionario = f.idFuncionario
				INNER JOIN servicos_salao as servS ON servS.idServicoSalao = serv.idServicoSalao
				WHERE f.idSalao ='" . $this->idSalao . "' AND serv.idServicoSalao IN (" . $valores . ")";
        return Dao::getInstancia()->executeSelect($query);
    }

    protected function feriasFuncionario()
    {
        $com = Dao::getInstancia();
        $conexao = $com->OpenConn();
        $query = "UPDATE funcionarios SET feriasIni=:feriasIni,feriasFim=:feriasFim  WHERE idFuncionario=:idFuncionario";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam("idFuncionario", $this->idFuncionario);
        $stmt->bindParam("feriasIni", $this->feriasIni);
        $stmt->bindParam("feriasFim", $this->feriasFim);
        return $stmt->execute();
    }

    protected function consult_feriasFuncionario()
    {
        $query = "SELECT feriasIni, feriasFim FROM funcionarios WHERE idFuncionario='" . $this->idFuncionario . "'";
        return Dao::getInstancia()->executeSelect($query);
    }

}
