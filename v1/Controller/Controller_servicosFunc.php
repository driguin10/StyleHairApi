<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_servicosFunc.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_servicosFunc.php', dirname(__FILE__));
}

class ServicoFunc extends ServicosFuncModel
{

    public function setIdServicoFunc($idServicoFunc)
    {
        $this->idServicoFunc = $idServicoFunc;
    }

    public function getIdServicoFunc()
    {
        return $this->idServicoFunc;
    }

    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    public function setIdServicoSalao($idServicoSalao)
    {
        $this->idServicoSalao = $idServicoSalao;
    }

    public function getIdServicoSalao()
    {
        return $this->idServicoSalao;
    }

//-----------------------------------------------

    public function consult_all()
    {
        return parent::consult_all();
    }

    public function consult_idFunc()
    {
        return parent::consult_idFunc();
    }

    public function consult_servicos_func()
    {
        return parent::consult_servicos_func();
    }

    public function consult_idFunc_idServ()
    {
        return parent::consult_idFunc_idServ();
    }

    public function sav_servicoFunc()
    {
        return parent::sav_servicoFunc();
    }

    public function alt_servicoFunc()
    {
        return parent::alt_servicoFunc();
    }

    public function exc_servicoFunc()
    {
        return parent::exc_servicoFunc();
    }

}
