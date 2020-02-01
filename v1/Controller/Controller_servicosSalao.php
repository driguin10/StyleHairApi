<?php

if (strpos(dirname(__FILE__), '\\') !== false) {
    include_once str_replace('Controller', 'model\model_servicosSalao.php', dirname(__FILE__));
} else {
    include_once str_replace('Controller', 'model/model_servicosSalao.php', dirname(__FILE__));
}

class ServicosSalao extends ServicosSalaoModel implements \JsonSerializable
{

    public function setIdServicoSalao($idServicoSalao)
    {
        $this->idServicoSalao = $idServicoSalao;
    }

    public function getIdServicoSalao()
    {
        return $this->idServicoSalao;
    }

    public function setIdSalao($idSalao)
    {
        $this->idSalao = $idSalao;
    }

    public function getIdSalao()
    {
        return $this->idSalao;
    }

    public function setServico($servico)
    {
        $this->servico = $servico;
    }

    public function getServico()
    {
        return $this->servico;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setTempo($tempo)
    {
        $this->tempo = $tempo;
    }

    public function getTempo()
    {
        return $this->tempo;
    }

//-----------------------------------------------

    public function consult_all()
    {
        return parent::consult_all();
    }

    public function consult_servicos_idSalao()
    {
        return parent::consult_servicos_idSalao();
    }

    public function consult_servicos_idsServico($ids)
    {
        return parent::consult_servicos_idsServico($ids);
    }

    public function sav_servicosSalao()
    {
        return parent::sav_servicosSalao();
    }

    public function alt_servicosSalao()
    {
        return parent::alt_servicosSalao();
    }

    public function exc_servicosSalao()
    {
        return parent::exc_servicosSalao();
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}
