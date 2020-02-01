<?php
include_once str_replace('Controller', 'model\model_feriasFunc.php', dirname(__FILE__));

class FeriasFunc extends FeriasFuncModel
{

    public function setIdFeriasFunc($idFeriasFunc)
    {
        $this->idFeriasFunc = $idFeriasFunc;
    }

    public function getIdFeriasFunc()
    {
        return $this->idFeriasFunc;
    }

    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    public function setDataIni($dataIni)
    {
        $this->dataIni = $dataIni;
    }

    public function getDataIni()
    {
        return $this->dataIni;
    }

    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;
    }

    public function getDataFim()
    {
        return $this->dataFim;
    }

//-----------------------------------------------

    public function consult_todos()
    {
        return parent::consult_todos();
    }

    public function consult_id()
    {
        return parent::consult_id();
    }

    public function sav_feriasFunc()
    {
        return parent::sav_feriasFunc();
    }

    public function alt_feriasFunc()
    {
        return parent::alt_feriasFunc();
    }

    public function exc_feriasFunc()
    {
        return parent::exc_feriasFunc();
    }

}
