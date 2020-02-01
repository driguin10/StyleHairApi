<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_funcionario.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_funcionario.php', dirname(__FILE__));
}

class Funcionario extends FuncionarioModel implements JsonSerializable
{

    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    public function setIdSalao($idSalao)
    {
        $this->idSalao = $idSalao;
    }

    public function getIdSalao()
    {
        return $this->idSalao;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setSegE($SegE)
    {
        $this->SegE = $SegE;
    }

    public function getSegE()
    {
        return $this->SegE;
    }

    public function setSegS($SegS)
    {
        $this->SegS = $SegS;
    }

    public function getSegS()
    {
        return $this->SegS;
    }

    public function setTerE($TerE)
    {
        $this->TerE = $TerE;
    }

    public function getTerE()
    {
        return $this->TerE;
    }

    public function setTerS($TerS)
    {
        $this->TerS = $TerS;
    }

    public function getTerS()
    {
        return $this->TerS;
    }

    public function setQuaE($QuaE)
    {
        $this->QuaE = $QuaE;
    }

    public function getQuaE()
    {
        return $this->QuaE;
    }

    public function setQuaS($QuaS)
    {
        $this->QuaS = $QuaS;
    }

    public function getQuaS()
    {
        return $this->QuaS;
    }

    public function setQuiE($QuiE)
    {
        $this->QuiE = $QuiE;
    }

    public function getQuiE()
    {
        return $this->QuiE;
    }

    public function setQuiS($QuiS)
    {
        $this->QuiS = $QuiS;
    }

    public function getQuiS()
    {
        return $this->QuiS;
    }

    public function setSexE($SexE)
    {
        $this->SexE = $SexE;
    }

    public function getSexE()
    {
        return $this->SexE;
    }

    public function setSexS($SexS)
    {
        $this->SexS = $SexS;
    }

    public function getSexS()
    {
        return $this->SexS;
    }

    public function setSabE($SabE)
    {
        $this->SabE = $SabE;
    }

    public function getSabE()
    {
        return $this->SabE;
    }

    public function setSabS($SabS)
    {
        $this->SabS = $SabS;
    }

    public function getSabS()
    {
        return $this->SabS;
    }

    public function setDomE($DomE)
    {
        $this->DomE = $DomE;
    }

    public function getDomE()
    {
        return $this->DomE;
    }

    public function setDomS($DomS)
    {
        $this->DomS = $DomS;
    }

    public function getDomS()
    {
        return $this->DomS;
    }

    public function setFeriasIni($feriasIni)
    {
        $this->feriasIni = $feriasIni;
    }

    public function getFeriasIni()
    {
        return $this->feriasIni;
    }

    public function setFeriasFim($feriasFim)
    {
        $this->feriasFim = $feriasFim;
    }

    public function getFeriasFim()
    {
        return $this->feriasFim;
    }

    public function setAlmocoIni($almocoIni)
    {
        $this->almocoIni = $almocoIni;
    }

    public function getAlmocoIni()
    {
        return $this->almocoIni;
    }

    public function setAlmocoFim($almocoFim)
    {
        $this->almocoFim = $almocoFim;
    }

    public function getAlmocoFim()
    {
        return $this->almocoFim;
    }

//-----------------------------------------------

    public function consult_todos_funcionarios()
    {
        return parent::consult_todos_funcionarios();
    }

    public function consult_funcionarios_idUsuario()
    {
        return parent::consult_funcionarios_idUsuario();
    }

    public function consult_funcionarios_idFuncionario()
    {
        return parent::consult_funcionarios_idFuncionario();
    }

    public function consult_funcionarios_idSalao()
    {
        return parent::consult_funcionarios_idSalao();
    }

    public function sav_funcionario()
    {
        return parent::sav_funcionario();
    }

    public function alt_funcionario()
    {
        return parent::alt_funcionario();
    }

    public function exc_funcionario()
    {
        return parent::exc_funcionario();
    }

    public function exc_funcionario_idUsuario()
    {
        return parent::exc_funcionario_idUsuario();
    }

    public function consult_funcionarios_busca($valores)
    {
        return parent::consult_funcionarios_busca($valores);
    }

    public function feriasFuncionario()
    {
        return parent::feriasFuncionario();
    }

    public function consult_feriasFuncionario()
    {
        return parent::consult_feriasFuncionario();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
